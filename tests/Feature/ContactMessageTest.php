<?php

namespace Tests\Feature;

use App\Mail\NewContactMessageNotification;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactMessageTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(): array
    {
        return [
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'subject' => 'Informazioni',
            'message' => 'Vorrei informazioni sull\'associazione.',
        ];
    }

    public function test_message_is_saved_and_admins_are_notified(): void
    {
        Mail::fake();
        $admin = User::factory()->create(['is_admin' => true]);
        User::factory()->create(['is_admin' => false]);

        $this->post('/contatti', $this->validPayload())
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', ['email' => 'mario@example.com']);
        Mail::assertSent(NewContactMessageNotification::class, 1);
        Mail::assertSent(NewContactMessageNotification::class, fn ($mail) => $mail->hasTo($admin->email));
    }

    public function test_message_is_saved_even_if_mail_fails(): void
    {
        User::factory()->create(['is_admin' => true]);
        Mail::shouldReceive('to')->andThrow(new \RuntimeException('SMTP down'));

        $this->post('/contatti', $this->validPayload())->assertSessionHas('success');

        $this->assertDatabaseCount('contact_messages', 1);
    }

    public function test_invalid_submissions_do_not_consume_the_limit(): void
    {
        Mail::fake();

        for ($i = 0; $i < 6; $i++) {
            $this->post('/contatti', ['name' => '']);
        }

        $this->post('/contatti', $this->validPayload())->assertSessionHas('success');
    }

    public function test_sixth_message_in_a_day_is_rejected(): void
    {
        Mail::fake();

        for ($i = 0; $i < 5; $i++) {
            $this->post('/contatti', $this->validPayload())->assertSessionHas('success');
        }

        $this->post('/contatti', $this->validPayload())->assertSessionHas('error');
        $this->assertDatabaseCount('contact_messages', 5);
    }

    public function test_subject_is_optional_as_the_form_says(): void
    {
        Mail::fake();
        $payload = $this->validPayload();
        unset($payload['subject']);

        $this->post('/contatti', $payload)->assertSessionHasNoErrors()->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', ['email' => 'mario@example.com', 'subject' => null]);
    }

    public function test_notification_email_renders(): void
    {
        $contactMessage = ContactMessage::create([
            'name' => 'Mario Rossi',
            'email' => 'mario@example.com',
            'subject' => 'Informazioni',
            'message' => 'Vorrei informazioni sull\'associazione.',
        ]);

        $html = (new NewContactMessageNotification($contactMessage))->render();

        $this->assertStringContainsString('Mario Rossi', $html);
        $this->assertStringContainsString('Vorrei informazioni', $html);
    }
}
