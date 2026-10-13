<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminContactMessagesTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['is_admin' => true]);
    }

    private function message(array $attributes = []): ContactMessage
    {
        $message = ContactMessage::create($attributes + [
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'subject' => 'Informazioni',
            'message' => 'Vorrei informazioni sull\'associazione.',
        ]);

        if (array_key_exists('read_at', $attributes)) {
            $message->forceFill(['read_at' => $attributes['read_at']])->save();
        }

        return $message;
    }

    public function test_opening_a_message_marks_it_as_read(): void
    {
        $message = $this->message();
        $this->assertFalse($message->isRead());

        $this->actingAs($this->admin)->get(route('admin.messages.show', $message))->assertOk();

        $this->assertTrue($message->fresh()->isRead());
    }

    public function test_message_can_be_marked_unread_again(): void
    {
        $message = $this->message(['read_at' => now()]);

        $this->actingAs($this->admin)
            ->patch(route('admin.messages.unread', $message))
            ->assertRedirect(route('admin.messages.index'));

        $this->assertFalse($message->fresh()->isRead());
    }

    public function test_unread_filter_shows_only_unread_messages(): void
    {
        $this->message(['subject' => 'Da leggere']);
        $this->message(['subject' => 'Già letto', 'read_at' => now()]);

        $this->actingAs($this->admin)
            ->get(route('admin.messages.index', ['filtro' => 'non-letti']))
            ->assertOk()
            ->assertSee('Da leggere')
            ->assertDontSee('Già letto')
            ->assertSee('1 non letto');
    }

    public function test_admin_can_delete_a_message(): void
    {
        $message = $this->message();

        $this->actingAs($this->admin)
            ->delete(route('admin.messages.destroy', $message))
            ->assertRedirect(route('admin.messages.index'));

        $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
    }

    public function test_messages_are_paginated(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            $this->message(['subject' => "Oggetto numero {$i}"]);
        }

        $this->actingAs($this->admin)
            ->get(route('admin.messages.index'))
            ->assertOk()
            ->assertViewHas('messages', fn ($messages) => $messages->count() === 20 && $messages->total() === 25);
    }

    public function test_non_admins_cannot_read_or_delete_messages(): void
    {
        $message = $this->message();
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get(route('admin.messages.show', $message))->assertForbidden();
        $this->actingAs($user)->delete(route('admin.messages.destroy', $message))->assertForbidden();

        $this->assertDatabaseHas('contact_messages', ['id' => $message->id, 'read_at' => null]);
    }

    public function test_dashboard_shows_unread_counter(): void
    {
        $this->message();
        $this->message();
        $this->message(['read_at' => now()]);

        $this->actingAs($this->admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('2 da leggere');
    }

    public function test_sender_name_cannot_inject_script_in_admin_pages(): void
    {
        $this->message(['name' => "');alert(1);('<script>x</script>"]);

        $this->actingAs($this->admin)
            ->get(route('admin.messages.index'))
            ->assertOk()
            ->assertDontSee("');alert(1);('", false)
            ->assertDontSee('<script>x</script>', false);
    }
}
