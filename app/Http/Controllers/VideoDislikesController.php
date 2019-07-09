<?php

namespace App\Http\Controllers;

use App\Dislike;
use App\Video;

class VideoDislikesController extends Controller
{
    public function store(Video $video)
    {
        $dislik = $video->dislikes()->where('user_id', auth()->id())->first();
        if ($dislik) {
            $dislik->delete();
            return response()->json([], 200);
        }

        $like = $video->likes()->where('user_id', auth()->id())->first();
        if ($like) {
            $like->delete();
        }

        Dislike::create([
            'disliked_id' => $video->id,
            'disliked_type' => Video::class,
            'user_id' => auth()->id(),
        ]);
    }
}
