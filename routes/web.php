<?php

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('feed/subscriptions', function () {
    return redirect()->route('welcome');
})->name('subscriptions')->middleware(['auth']);
