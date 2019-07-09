<?php

namespace App\Http\Controllers;

use App\Video;

class WatchVideoController extends Controller
{
    public function show(Video $video)
    {
        return view('videos.show', compact('video'));
    }
}
