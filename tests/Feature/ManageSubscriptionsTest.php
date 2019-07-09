<?php

namespace Tests\Feature;

use App\User;
use App\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageSubscriptionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_subscribe_to_a_channel()
    {
        $this->withoutExceptionHandling();

        $channel = factory(Channel::class)->create();
        $user = factory(User::class)->create();

        $this->be($user);

        $this->postJson(route('subscribe', $channel))
            ->assertStatus(201);

        $user = $user->fresh();
        $channel = $channel->fresh();

        $this->assertCount(1, $user->subscriptions);
        $this->assertTrue($channel->isSubscribed($user));
    }

    /** @test */
    public function guests_can_not_subscribe_to_channels()
    {
        $channel = factory(Channel::class)->create();
        $user = factory(User::class)->create();

        $this->postJson(route('subscribe', $channel))
            ->assertStatus(401);
    }

    /** @test */
    public function a_user_can_unsubscribe_to_a_channel()
    {
        $this->withoutExceptionHandling();

        $channel = factory(Channel::class)->create();
        $user = factory(User::class)->create();
        $channel->subscribe($user);

        $this->be($user);

        $this->deleteJson(route('unsubscribe', $channel))
            ->assertStatus(200);

        $user = $user->fresh();
        $channel = $channel->fresh();

        $this->assertCount(0, $user->subscriptions);
        $this->assertFalse($channel->isSubscribed($user));
    }

    /** @test */
    public function guests_can_not_unsubscribe_to_channels()
    {
        $channel = factory(Channel::class)->create();
        $user = factory(User::class)->create();

        $channel->subscribe($user);

        $this->deleteJson(route('unsubscribe', $channel))
            ->assertStatus(401);
    }
}
