<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('feed/subscriptions', function () {
    return redirect()->route('welcome');
})->name('subscriptions')->middleware(['auth']);

Route::view('watch/{video}', 'videos.show')->name('videos.watch');

/**
 * Subscriptions
 */
Route::post('subscribe/{channel}', 'ChannelSubscriptionsController@store')->name('subscribe')->middleware(['auth']);
Route::post('unsubscribe/{channel}', 'ChannelSubscriptionsController@destroy')->name('unsubscribe')->middleware(['auth']);
