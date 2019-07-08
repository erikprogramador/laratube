<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use App\Channel;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'owner_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
