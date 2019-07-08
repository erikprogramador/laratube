<?php

namespace Tests\Feature;

use App\User;
use App\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageChannelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function channel_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $channel = factory(Channel::class)->create([
            'name' => 'Default Channel name',
            'description' => 'Default Channel description',
            'owner_id' => $user->id,
        ]);

        $this->be($user);

        $this->put(route('channels.update', $channel), [
            'name' => 'Updated Channel name',
            'description' => 'Updated Channel description',
        ])->assertStatus(200)
            ->assertJsonFragment([
                'id' => $channel->id,
                'name' => 'Updated Channel name',
                'description' => 'Updated Channel description',
            ]);

        $channel = $channel->fresh();

        $this->assertEquals($channel->name, 'Updated Channel name');
        $this->assertEquals($channel->description, 'Updated Channel description');
    }

    /** @test */
    public function guests_can_not_update_channels()
    {
        $channel = factory(Channel::class)->create([
            'name' => 'Default Channel name',
            'description' => 'Default Channel description',
        ]);

        $this->put(route('channels.update', $channel), [
            'name' => 'Updated Channel name',
            'description' => 'Updated Channel description',
        ])->assertStatus(302);
    }

    /** @test */
    public function not_channel_owner_can_not_update_it()
    {
        $user = factory(User::class)->create();
        $channel = factory(Channel::class)->create([
            'name' => 'Default Channel name',
            'description' => 'Default Channel description',
            'owner_id' => factory(User::class)->create()->id,
        ]);

        $this->be($user);

        $this->put(route('channels.update', $channel), [
            'name' => 'Updated Channel name',
            'description' => 'Updated Channel description',
        ])->assertStatus(403);
    }

    /** @test */
    public function the_channel_name_is_required()
    {
        $user = factory(User::class)->create();
        $channel = factory(Channel::class)->create([
            'name' => 'Default Channel name',
            'description' => 'Default Channel description',
            'owner_id' => $user->id,
        ]);

        $this->be($user);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        $this->put(route('channels.update', $channel), [
            'name' => '',
            'description' => 'Updated Channel description',
        ])->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function any_user_can_see_a_channel()
    {
        $channel = factory(Channel::class)->create();

        $this->get(route('channels.show', $channel))
            ->assertStatus(200)
            ->assertViewHas('channel', $channel);
    }
}
