<?php

namespace Tests\Unit;

use App\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generate_a_random_slug_when_is_created()
    {
        $channel = factory(Channel::class)->create();

        $this->assertNotNull($channel->slug);
    }
}
