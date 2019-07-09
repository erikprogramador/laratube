<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->owner_id;
    }

    public function destroy(User $user, Comment $comment)
    {
        return $user->id === $comment->owner_id;
    }
}
