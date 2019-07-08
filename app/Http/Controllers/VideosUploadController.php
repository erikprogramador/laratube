<?php

namespace App\Http\Controllers;

use App\Channel;

class VideosUploadController extends Controller
{
    public function __invoke(Channel $channel)
    {
        $file = request()->file('video')->store("videos/{$channel->id}/videos");

        return response()->json([
            'video_path' => $file,
        ], 201);
    }
}
