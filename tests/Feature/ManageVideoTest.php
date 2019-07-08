<?php

namespace Tests\Feature;

use App\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageVideoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_upload_videos_to_their_channels()
    {
        $this->withoutExceptionHandling();

        $channel = factory(Channel::class)->create();

        $this->be($channel->owner);

        $this->postJson(route('videos.store', $channel), [
            'title' => 'My first video',
            'description' => 'My video description',
            'video_file' => "videos/{$channel->id}/videos/video.mp4",
            'thumb_file' => "videos/{$channel->id}/thumbnail/video.png",
            'status' => 1,
            'visibility' => 0,
            'tags' => [
                'first video'
            ],
        ])->assertStatus(200);

        $this->assertDatabaseHas('videos', [
            'title' => 'My first video',
            'description' => 'My video description',
            'video_file' => "videos/{$channel->id}/videos/video.mp4",
            'thumb_file' => "videos/{$channel->id}/thumbnail/video.png",
            'channel_id' => $channel->id,
            'status' => 1,
            'visibility' => 0,
        ]);

        $this->assertDatabaseHas('tags', [
            'name' => 'first video',
        ]);

        $this->assertDatabaseHas('tag_video', [
            'video_id' => 1,
            'tag_id' => 1,
        ]);
    }

    /** @test */
    public function guests_can_not_upload_videos()
    {
        $channel = factory(Channel::class)->create();

        $this->postJson(route('videos.store', $channel), [
            'title' => 'My first video',
            'description' => 'My video description',
            'video_file' => "videos/{$channel->id}/videos/video.mp4",
            'thumb_file' => "videos/{$channel->id}/thumbnail/video.png",
            'status' => 1,
            'visibility' => 0,
            'tags' => [
                'first video'
            ],
        ])->assertStatus(401);
    }

    /** @test */
    public function title_is_required()
    {
        $channel = factory(Channel::class)->create();

        $this->be($channel->owner);

        $this->postJson(route('videos.store', $channel), [
            'title' => '',
            'description' => 'My video description',
            'video_file' => "videos/{$channel->id}/videos/video.mp4",
            'thumb_file' => "videos/{$channel->id}/thumbnail/video.png",
            'status' => 1,
            'visibility' => 0,
            'tags' => [
                'first video'
            ],
        ])->assertJsonValidationErrors(['title']);
    }

    /** @test */
    public function video_file_is_required()
    {
        $channel = factory(Channel::class)->create();

        $this->be($channel->owner);

        $this->postJson(route('videos.store', $channel), [
            'title' => 'My first video',
            'description' => 'My video description',
            'video_file' => "",
            'thumb_file' => "videos/{$channel->id}/thumbnail/video.png",
            'status' => 1,
            'visibility' => 0,
            'tags' => [
                'first video'
            ],
        ])->assertJsonValidationErrors(['video_file']);
    }

    /** @test */
    public function thumb_file_is_required()
    {
        $channel = factory(Channel::class)->create();

        $this->be($channel->owner);

        $this->postJson(route('videos.store', $channel), [
            'title' => 'My first video',
            'description' => 'My video description',
            'video_file' => "videos/{$channel->id}/thumbnail/video.mp4",
            'thumb_file' => "",
            'status' => 1,
            'visibility' => 0,
            'tags' => [
                'first video'
            ],
        ])->assertJsonValidationErrors(['thumb_file']);
    }
}
