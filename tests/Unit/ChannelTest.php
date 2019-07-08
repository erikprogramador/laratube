<?php

namespace Tests\Unit;

use App\User;
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

    /** @test */
    public function it_has_a_owner()
    {
        $owner = factory(User::class)->create();
        $channel = factory(Channel::class)->create([
            'owner_id' => $owner->id,
        ]);

        $this->assertTrue($channel->owner->is($owner));
    }

    /** @test */
    public function it_can_subscribe_a_user()
    {
        $user = factory(User::class)->create();
        $channel = factory(Channel::class)->create();

        $channel->subscribe($user);

        $this->assertNotNull($channel->isSubscribed($user));
    }

    /** @test */
    public function it_can_not_subscribe_a_user_twice()
    {
        $user = factory(User::class)->create();
        $channel = factory(Channel::class)->create();

        $channel->subscribe($user);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $channel->subscribe($user);

        $this->assertNotNull($channel->subscribers->contains($user));
    }

    /** @test */
    public function it_can_determine_if_user_is_subscribed()
    {
        $user = factory(User::class)->create();
        $channel = factory(Channel::class)->create();

        $channel->subscribe($user);

        $this->assertTrue($channel->isSubscribed($user));
    }

    /** @test */
    public function it_can_unsubscribe_user()
    {
        $user = factory(User::class)->create();
        $channel = factory(Channel::class)->create();

        $channel->subscribe($user);

        $this->assertTrue($channel->isSubscribed($user));

        $channel->unsubscribe($user);
        $this->assertFalse($channel->fresh()->isSubscribed($user));
    }

    /** @test */
    public function it_on_unsubscribe_user_from_the_correct_channel()
    {
        $user = factory(User::class)->create();
        $channelToNotUnsubscribe = factory(Channel::class)->create();
        $channel = factory(Channel::class)->create();

        $channelToNotUnsubscribe->subscribe($user);
        $channel->subscribe($user);

        $this->assertTrue($channel->isSubscribed($user));

        $channel->unsubscribe($user);
        $this->assertFalse($channel->fresh()->isSubscribed($user));
        $this->assertTrue($channelToNotUnsubscribe->isSubscribed($user));
    }
}
