<?php

namespace App\Http\Controllers;

use App\Like;
use App\Video;

class VideoLikesController extends Controller
{
    public function store(Video $video)
    {
        $lik = $video->likes()->where('user_id', auth()->id())->first();
        if ($lik) {
            $lik->delete();
            return response()->json([], 200);
        }

        Like::create([
            'liked_id' => $video->id,
            'liked_type' => Video::class,
            'user_id' => auth()->id(),
        ]);
    }
}
