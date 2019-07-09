<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Video;
use App\Channel;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'video_file' => "videos/1/videos/video.mp4",
        'thumb_file' => "videos/1/thumbnail/video.png",
        'status' => 1,
        'visibility' => 0,
        'channel_id' => function() {
            return factory(Channel::class)->create()->id;
        },
    ];
});
