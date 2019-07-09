<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'owner_id' => 'int',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
