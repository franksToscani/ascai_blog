<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminEventSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_in_description_respects_location_filter(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $base = ['starts_at' => now()->addDays(5), 'status' => 'published', 'is_public' => true];

        Event::create($base + ['title' => 'Concerto A', 'description' => 'Concerto di musica a Bologna', 'location' => 'Bologna']);
        Event::create($base + ['title' => 'Concerto B', 'description' => 'Concerto di musica a Modena', 'location' => 'Modena']);

        $this->actingAs($admin)
            ->get(route('admin.events.index', ['search' => 'Concerto', 'location' => 'Bologna']))
            ->assertOk()
            ->assertSee('Concerto A')
            ->assertDontSee('Concerto B');
    }
}
