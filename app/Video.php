<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = str_random(16);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'liked');
    }

    public function dislikes()
    {
        return $this->morphMany(Dislike::class, 'disliked');
    }
}
