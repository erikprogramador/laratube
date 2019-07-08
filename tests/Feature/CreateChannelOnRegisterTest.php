<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateChannelOnRegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function when_registering_user_may_create_a_channel_for_this_user()
    {
        $this->withoutExceptionHandling();

        $this->post(route('register'), [
            'name' => 'Erik V. Fernandes',
            'email' => 'erik@salescity.com.br',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Erik V. Fernandes',
            'email' => 'erik@salescity.com.br',
        ]);

        $this->assertDatabaseHas('channels', [
            'name' => 'Erik V. Fernandes',
            'owner_id' => 1,
        ]);
    }
}
