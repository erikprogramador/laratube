<?php

namespace App\Http\Controllers;

use App\Channel;

class ChannelsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return view('channels.show', compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Channel $channel)
    {
        $this->authorize('update', $channel);

        $attributes = request()->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'description' => ['nullable', 'min:3'],
        ]);

        $channel->update($attributes);

        return response()->json([
            'channel' => $channel,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
