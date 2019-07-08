<?php

/**
 * Pages
 */
// History
// Like
// trending
// subscriptions
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('feed/subscriptions', function () {
    return redirect()->route('welcome');
})->name('subscriptions')->middleware(['auth']);

Auth::routes();

Route::view('watch/{video}', 'videos.show')->name('videos.watch');

/**
 * Subscriptions
 */
Route::post('subscribe/{channel}', 'ChannelSubscriptionsController@store')->name('subscribe')->middleware(['auth']);
Route::post('unsubscribe/{channel}', 'ChannelSubscriptionsController@destroy')->name('unsubscribe')->middleware(['auth']);

/**
 * Channels
 */
Route::get('channel/{channel}', 'ChannelsController@show')->name('channels.show');
Route::put('channel/{channel}', 'ChannelsController@update')->name('channels.update')->middleware(['auth']);
Route::delete('channel/{channel}', 'ChannelsController@destroy')->name('channels.destroy')->middleware(['auth']);

/**
 * Videos
 */

/**
 * Comments
 */

/**
 * Likes
 */

/**
 * Notifications
 */
