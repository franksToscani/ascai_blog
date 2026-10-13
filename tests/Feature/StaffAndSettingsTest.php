<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\StaffMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StaffAndSettingsTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        $this->admin = User::factory()->create(['is_admin' => true]);
    }

    public function test_staff_page_shows_the_current_board_after_migration(): void
    {
        $this->get(route('staff-ascaibo'))
            ->assertOk()
            ->assertSeeInOrder(['Presidente', 'Jemes Tonnang', 'Vicepresidente', 'Tesoriere'])
            ->assertSee("Rappresentante legale dell'associazione")
            ->assertSee('Comitato Sportivo');
    }

    public function test_admin_can_add_a_member_with_photo(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.staff.store'), [
                'group' => 'direttivo',
                'role' => 'Consigliere',
                'name' => 'Marie Ngo',
                'photo' => UploadedFile::fake()->image('marie.jpg', 1200, 1200),
            ])
            ->assertRedirect(route('admin.staff.index'));

        $member = StaffMember::where('name', 'Marie Ngo')->firstOrFail();
        $this->assertSame(StaffMember::where('group', 'direttivo')->max('position'), $member->position);
        [$width] = getimagesize(Storage::disk('public')->path($member->photo_path));
        $this->assertSame(400, $width);

        $this->get(route('staff-ascaibo'))->assertSee('Marie Ngo')->assertSee($member->photo_url);
    }

    public function test_members_can_be_reordered_within_their_group(): void
    {
        $vice = StaffMember::where('role', 'Vicepresidente')->firstOrFail();

        $this->actingAs($this->admin)->patch(route('admin.staff.move', $vice), ['direction' => 'up']);

        $this->assertSame(
            ['Vicepresidente', 'Presidente', 'Segretario generale', 'Tesoriere'],
            StaffMember::inGroup('direttivo')->pluck('role')->all()
        );
    }

    public function test_removing_a_member_deletes_the_photo(): void
    {
        Storage::disk('public')->put('staff/foto.jpg', 'x');
        $member = StaffMember::create(['group' => 'collaboratori', 'role' => 'Comitato X', 'photo_path' => 'staff/foto.jpg']);

        $this->actingAs($this->admin)->delete(route('admin.staff.destroy', $member));

        $this->assertModelMissing($member);
        Storage::disk('public')->assertMissing('staff/foto.jpg');
    }

    public function test_membership_page_no_longer_shows_placeholder_payment_data(): void
    {
        $this->get(route('associati'))
            ->assertOk()
            ->assertDontSee('IT00 A000')
            ->assertDontSee('importo ...')
            ->assertSee('contattaci')
            ->assertSee('docs.google.com/forms', false);
    }

    public function test_saved_payment_data_appears_on_membership_page(): void
    {
        $this->actingAs($this->admin)
            ->put(route('admin.settings.update'), [
                'membership_fee' => '20 €',
                'payment_holder' => 'AS.CA.I Bologna <script>alert(1)</script>',
                'payment_iban' => 'it60 x054 2811 1010 0000 0123 456',
                'payment_reason' => 'Quota associativa 2026 - Nome Cognome',
                'membership_form_url' => 'https://example.org/modulo',
            ])
            ->assertRedirect(route('admin.settings.edit'))
            ->assertSessionHasNoErrors();

        $this->assertSame('IT60X0542811101000000123456', Setting::get('payment_iban'));

        $this->get(route('associati'))
            ->assertOk()
            ->assertSee('20 €')
            ->assertSee('IT60 X054 2811 1010 0000 0123 456')
            ->assertSee('https://example.org/modulo', false)
            ->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_invalid_iban_and_form_link_are_rejected(): void
    {
        $this->actingAs($this->admin)
            ->put(route('admin.settings.update'), ['payment_iban' => '12345', 'membership_form_url' => 'non-un-link'])
            ->assertSessionHasErrors(['payment_iban', 'membership_form_url']);
    }

    public function test_statute_pdf_button_appears_only_after_upload_and_old_file_is_replaced(): void
    {
        $this->get(route('statuto'))->assertOk()->assertDontSee('Scarica lo statuto (PDF)');

        $this->actingAs($this->admin)->put(route('admin.settings.update'), [
            'statuto_pdf' => UploadedFile::fake()->create('statuto.pdf', 200, 'application/pdf'),
        ]);
        $first = Setting::get('statuto_pdf_path');
        Storage::disk('public')->assertExists($first);

        $this->get(route('statuto'))->assertSee('Scarica lo statuto (PDF)')->assertSee(asset('storage/' . $first));

        $this->travel(2)->seconds();
        $this->actingAs($this->admin)->put(route('admin.settings.update'), [
            'statuto_pdf' => UploadedFile::fake()->create('nuovo.pdf', 200, 'application/pdf'),
        ]);

        $this->assertNotSame($first, Setting::get('statuto_pdf_path'));
        Storage::disk('public')->assertMissing($first);
    }

    public function test_orphan_cleanup_keeps_staff_photos_and_statute(): void
    {
        foreach (['staff/foto.jpg', 'documenti/statuto.pdf'] as $path) {
            Storage::disk('public')->put($path, 'x');
            touch(Storage::disk('public')->path($path), time() - 7200);
        }
        StaffMember::create(['group' => 'direttivo', 'role' => 'Consigliere', 'photo_path' => 'staff/foto.jpg']);
        Setting::put('statuto_pdf_path', 'documenti/statuto.pdf');

        $this->artisan('storage:clean-orphans', ['--force' => true])->expectsOutputToContain('Nessun file orfano');
    }

    public function test_non_admins_cannot_edit_staff_or_settings(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get(route('admin.staff.index'))->assertForbidden();
        $this->actingAs($user)->put(route('admin.settings.update'), ['membership_fee' => '1 €'])->assertForbidden();
        $this->assertNull(Setting::get('membership_fee'));
    }
}
