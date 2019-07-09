<?php

namespace Tests\Unit;

use App\Video;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_create_a_random_slug_when_creating()
    {
        $video = factory(Video::class)->create(['slug' => null]);

        $this->assertNotNull($video->slug);
    }
}
