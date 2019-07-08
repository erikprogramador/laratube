<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class ChannelSubscriptionsController extends Controller
{
    public function store(Channel $channel)
    {
        $channel->subscribe(auth()->user());

        return response()->json([], 201);
    }

    public function destroy(Channel $channel)
    {
        $channel->unsubscribe(auth()->user());

        return response()->json([], 200);
    }
}
