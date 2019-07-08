<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [];

    protected $casts = [
        'user_id' => 'int',
        'channel_id' => 'int',
    ];
}
