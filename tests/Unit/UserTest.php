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
}
