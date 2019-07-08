<?php

namespace Tests\Unit;

use App\User;
use App\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_ha_one_channel()
    {
        $user = factory(User::class)->create();

        $channel = $user->channel()->create([
            'name' => $user->name,
        ]);

        $this->assertTrue($user->fresh()->channel->is($channel));
    }

    /** @test */
    public function it_can_get_its_subscriptions()
    {
        $user = factory(User::class)->create();
        $channel = factory(Channel::class)->create();

        $channel->subscribe($user);

        $this->assertCount(1, $user->fresh()->subscriptions);
    }
}
