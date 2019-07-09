<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = [];

    protected $casts = [
        'owner_id' => 'int',
    ];

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

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscribe($user)
    {
        $this->subscriptions()->create([
            'user_id' => $user->id,
        ]);

        return $this;
    }

    public function unsubscribe($user)
    {
        $this->subscriptions()
            ->where('user_id', $user->id)
            ->delete();

        return $this;
    }

    public function isSubscribed($user)
    {
        return $this->subscriptions->contains(function ($subscription) use ($user) {
            return $user->id === $subscription->user_id;
        });
    }
}
