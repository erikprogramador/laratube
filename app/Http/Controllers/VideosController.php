<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Video;
use App\Channel;

class VideosController extends Controller
{
    public function store(Channel $channel)
    {
        $atributes = request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['nullable'],
            'video_file' => ['required'],
            'thumb_file' => ['required'],
            'status' => ['nullable'],
            'visibility' => ['nullable'],
        ]);

        $video = Video::create($atributes + ['channel_id' => $channel->id]);

        collect(request('tags'))->each(function ($tag) use ($video) {
            $video->tags()->create([
                'name' => $tag,
            ]);
        });

        return response()->json([], 200);
    }
}
