<?php

namespace Tests\Feature;

use App\User;
use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_video_can_receive_a_comment()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);

        $this->postJson(route('video.comments.store', $video), [
            'body' => 'My awesome comment',
        ])->assertStatus(201);

        $this->assertDatabaseHas('comments', [
            'body' => 'My awesome comment',
            'commentable_id' => $video->id,
            'commentable_type' => Video::class,
        ]);
    }

    /** @test */
    public function guests_can_not_post_comments()
    {
        $video = factory(Video::class)->create();

        $this->postJson(route('video.comments.store', $video), [
            'body' => 'My awesome comment',
        ])->assertStatus(401);
    }

    /** @test */
    public function a_body_is_required()
    {
        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.comments.store', $video), [
            'body' => '',
        ])->assertJsonValidationErrors(['body']);
    }

    /** @test */
    public function a_comment_may_be_associated_with_a_owner()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.comments.store', $video), [
            'body' => 'My awesome comment',
        ]);

        $this->assertEquals($user->id, $video->comments->first()->owner_id);
    }

    /** @test */
    public function comments_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.comments.store', $video), [
            'body' => 'My awesome comment',
        ]);

        $this->putJson(route('video.comments.update', [$video, $video->comments->first()]), [
            'body' => 'My edited comment',
        ])->assertStatus(200);

        $this->assertEquals('My edited comment', $video->fresh()->comments->first()->body);
    }

    /** @test */
    public function guests_can_not_update_comments()
    {
        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.comments.store', $video), [
            'body' => 'My awesome comment',
        ]);

        auth()->logout();

        $this->putJson(route('video.comments.update', [$video, $video->comments->first()]), [
            'body' => 'My edited comment',
        ])->assertStatus(401);
    }

    /** @test */
    public function only_the_owner_can_update_their_comment()
    {
        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.comments.store', $video), [
            'body' => 'My awesome comment',
        ]);

        $this->be($notAllowed = factory(User::class)->create());

        $this->putJson(route('video.comments.update', [$video, $video->comments->first()]), [
            'body' => 'My edited comment',
        ])->assertStatus(403);
    }

    /** @test */
    public function comments_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.comments.store', $video), [
            'body' => 'My awesome comment',
        ]);

        $this->deleteJson(route('video.comments.destroy', [$video, $video->comments->first()]))
            ->assertStatus(200);

        $this->assertDatabaseMissing('comments', [
            'body' => 'My awesome comment',
        ]);
    }

    /** @test */
    public function guests_can_not_delete_comments()
    {
        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.comments.store', $video), [
            'body' => 'My awesome comment',
        ]);

        auth()->logout();
        $this->deleteJson(route('video.comments.destroy', [$video, $video->comments->first()]))
            ->assertStatus(401);
    }

    /** @test */
    public function not_comment_owner_can_not_delete_comment()
    {
        $user = factory(User::class)->create();
        $video = factory(Video::class)->create();

        $this->be($user);
        $this->postJson(route('video.comments.store', $video), [
            'body' => 'My awesome comment',
        ]);

        $this->be($notAllowed = factory(User::class)->create());
        $this->deleteJson(route('video.comments.destroy', [$video, $video->comments->first()]))
            ->assertStatus(403);
    }
}
