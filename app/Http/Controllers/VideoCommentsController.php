<?php

namespace App\Http\Controllers;

use App\Video;
use App\Comment;

class VideoCommentsController extends Controller
{
    public function store(Video $video)
    {
        request()->validate([
            'body' => ['required', 'min:3'],
        ]);

        Comment::create([
            'body' => request('body'),
            'commentable_type' => Video::class,
            'commentable_id' => $video->id,
            'owner_id' => auth()->id(),
        ]);

        return response()->json([], 201);
    }

    public function update(Video $video, Comment $comment)
    {
        $this->authorize('update', $comment);

        request()->validate([
            'body' => ['required', 'min:3'],
        ]);

        $comment->update(request(['body']));

        return response()->json([
            'comment' => $comment->fresh(),
        ], 200);
    }

    public function destroy(Video $video, Comment $comment)
    {
        $this->authorize('destroy', $comment);

        $comment->delete();
    }
}
