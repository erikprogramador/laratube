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

Route::get('watch/{video}', 'WatchVideoController@show')->name('videos.watch');

/**
 * Subscriptions
 */
Route::post('subscribe/{channel}', 'ChannelSubscriptionsController@store')->name('subscribe')->middleware(['auth']);
Route::delete('unsubscribe/{channel}', 'ChannelSubscriptionsController@destroy')->name('unsubscribe')->middleware(['auth']);

/**
 * Channels
 */
Route::get('channel/{channel}', 'ChannelsController@show')->name('channels.show');
Route::put('channel/{channel}', 'ChannelsController@update')->name('channels.update')->middleware(['auth']);
Route::delete('channel/{channel}', 'ChannelsController@destroy')->name('channels.destroy')->middleware(['auth']);

/**
 * Videos
 */
Route::post('videos/{channel}', 'VideosController@store')->name('videos.store')->middleware(['auth']);
Route::post('videos/{channel}/upload', 'VideosUploadController')->name('videos.upload')->middleware(['auth']);

/**
 * Comments
 */
Route::post('video/{video}/comments', 'VideoCommentsController@store')->name('video.comments.store')->middleware(['auth']);
Route::put('video/{video}/comments/{comment}', 'VideoCommentsController@update')->name('video.comments.update')->middleware(['auth']);
Route::delete('video/{video}/comments/{comment}', 'VideoCommentsController@destroy')->name('video.comments.destroy')->middleware(['auth']);

/**
 * Likes
 */
Route::post('video/{video}/like', 'VideoLikesController@store')->name('video.likes.store')->middleware(['auth']);
Route::post('video/{video}/dislike', 'VideoDislikesController@store')->name('video.dislikes.store')->middleware(['auth']);

/**
 * Notifications
 */
