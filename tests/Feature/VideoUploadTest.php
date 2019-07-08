<?php

namespace Tests\Feature;

use App\Channel;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoUploadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_upload_a_video()
    {
        $channel = factory(Channel::class)->create();

        Storage::fake('local');

        $this->be($channel->owner);

        $response = $this->postJson(route('videos.upload', $channel), [
            'video' => $file = UploadedFile::fake()->create('video.mp4'),
        ])->assertStatus(201)
            ->assertJsonFragment([
                'video_path' => "videos/{$channel->id}/videos/{$file->hashName()}"
            ]);

        Storage::disk('local')->assertExists("videos/{$channel->id}/videos/{$file->hashName()}");
    }

    /** @test */
    public function guests_can_not_upload_video()
    {
        $channel = factory(Channel::class)->create();

        Storage::fake('local');

        $response = $this->postJson(route('videos.upload', $channel), [
            'video' => $file = UploadedFile::fake()->create('video.mp4'),
        ])->assertStatus(401);

        Storage::disk('local')->assertMissing("videos/{$channel->id}/videos/{$file->hashName()}");
    }

    /** @test */
    public function when_upload_video_may_create_a_thumbnail()
    {
        $channel = factory(Channel::class)->create();

        Storage::fake('local');

        $this->be($channel->owner);

        $file = UploadedFile::fake()->create('video.mp4');

        $thumbHash = str_replace('.mp4', '.png', $file->hashName());

        $response = $this->postJson(route('videos.upload', $channel), [
            'video' => $file,
        ])->assertStatus(201)
            ->assertJsonFragment([
                'thumb_path' => "videos/{$channel->id}/thumbnail/{$thumbHash}"
            ]);

        Storage::disk('local')->assertExists("videos/{$channel->id}/thumbnail/{$thumbHash}");
    }
}
