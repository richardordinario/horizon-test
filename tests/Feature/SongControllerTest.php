<?php

namespace Tests\Feature;

use App\Models\Song;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SongControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_a_inertia_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('songs.index'));

        $response->assertStatus(200)
            ->assertInertia(fn ($page) => $page
                ->component('Songs/Index')
                ->has('songs'));
    }

    /** @test */
    public function it_returns_a_specific_song()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $song = Song::factory()->create();
        $response = $this->getJson("songs/random");
        $response->assertStatus(200)
                ->assertJson([
                    'id' => $song->id,
                    'title' => $song->title,
                    'artist' => $song->artist,
                    'file_url' => $song->file_url,
                ]);
    }
}
