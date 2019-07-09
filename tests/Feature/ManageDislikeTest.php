<?php

namespace Tests\Feature;

use App\User;
use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageDislikeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_video_can_be_disliked()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.dislikes.store', $video))
            ->assertStatus(200);

        $this->assertDatabaseHas('dislikes', [
            'disliked_id' => $video->id,
            'disliked_type' => Video::class,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function guests_can_not_dislike_videos()
    {
        $video = factory(Video::class)->create();

        $this->postJson(route('video.dislikes.store', $video))
            ->assertStatus(401);
    }

    /** @test */
    public function a_user_can_remove_he_dislike()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.dislikes.store', $video));
        $this->postJson(route('video.dislikes.store', $video));

        $this->assertDatabaseMissing('dislikes', [
            'disliked_id' => $video->id,
            'disliked_type' => Video::class,
            'user_id' => $user->id,
        ]);
    }
}
