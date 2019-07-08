<?php

namespace App\Policies;

use App\User;
use App\Channel;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChannelPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Channel $channel)
    {
        return $user->id === $channel->owner_id;
    }

    public function destroy(User $user, Channel $channel)
    {
        return $user->id === $channel->owner_id;
    }
}
