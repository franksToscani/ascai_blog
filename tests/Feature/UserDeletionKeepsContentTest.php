<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDeletionKeepsContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_deleting_a_user_keeps_their_posts(): void
    {
        $user = User::factory()->create();
        $post = Post::create([
            'title' => 'News di un utente',
            'content' => 'Contenuto',
            'status' => 'published',
            'user_id' => $user->id,
        ]);

        $user->delete();

        $this->assertNotNull($post->fresh());
        $this->assertNull($post->fresh()->user_id);
    }
}
