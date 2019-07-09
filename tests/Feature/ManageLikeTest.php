<?php

namespace Tests\Feature;

use App\User;
use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageLikeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_video_can_be_liked()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.likes.store', $video))
            ->assertStatus(200);

        $this->assertDatabaseHas('likes', [
            'liked_id' => $video->id,
            'liked_type' => Video::class,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function guests_can_not_like_videos()
    {
        $video = factory(Video::class)->create();

        $this->postJson(route('video.likes.store', $video))
            ->assertStatus(401);
    }

    /** @test */
    public function a_user_can_remove_he_like()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.likes.store', $video));
        $this->postJson(route('video.likes.store', $video));

        $this->assertDatabaseMissing('likes', [
            'liked_id' => $video->id,
            'liked_type' => Video::class,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function when_have_a_dislike_only_the_like_may_persist()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);

        $this->postJson(route('video.dislikes.store', $video));
        $this->postJson(route('video.likes.store', $video));

        $this->assertDatabaseMissing('dislikes', [
            'disliked_id' => $video->id,
            'disliked_type' => Video::class,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('likes', [
            'liked_id' => $video->id,
            'liked_type' => Video::class,
            'user_id' => $user->id,
        ]);
    }
}
