<?php

use App\Http\Controllers\Frontend\{Actions\Artist\ViewPostAction,
    Actions\ListingAction,
    Actions\Pages\ForArtistAction,
    HomeController,
    SingleController,
    AuthorController,
    ArtistController,
    PageController,
    GalleryController,
    Actions\ReactionAction,
    Actions\RssNewsAction};

Route::group([ 'middleware' => [ 'web', 'auth' ], 'as' => 'artist.', 'prefix' => 'artist', ], function () {
    Route::match(['GET', 'PUT'], 'profile', \App\Http\Controllers\Frontend\Actions\Artist\ArtistProfileAction::class)->name('profile');

    Route::match(['GET', 'POST'], 'setting', \App\Http\Controllers\Frontend\Actions\Artist\ArtistSettingAction::class)->name('setting');
});

Route::group([ 'middleware' => [ 'web' ] ], function () {

    Route::get('/', HomeController::class)->name('home');

    Route::match([ 'GET', 'POST' ], '/artist/register', \App\Http\Controllers\Frontend\Actions\Auth\RegisterAction::class)
        ->middleware('guest')
        ->name('artist.register');

    Route::get('/listing', ListingAction::class)->name('listing');
    Route::get('/for-artist', ForArtistAction::class)->name('for-artist');

    Route::get('/author/{author}', AuthorController::class)->name('author.single');
    Route::get('/artist/{artist}', ArtistController::class)->name('artist.single');

    Route::get('/page/{slug}', PageController::class)->name('page.single');
    Route::get('/post/{slug}', ViewPostAction::class)->name('post.single');

    Route::get('/gallery/{slug?}', GalleryController::class)->name('gallery');

    Route::post('/feedback/reaction', ReactionAction::class)
        ->name('feedback.reaction')
        ->middleware('nep.ajax');

    Route::get('news/rss', RssNewsAction::class)->name('news.rss');

    Route::group([ 'middleware' => [ 'guest' ], 'as' => 'app.', 'prefix' => 'app',  ], function () {
        Route::match([ 'GET', 'POST' ], 'login', \App\Http\Controllers\Frontend\Actions\Auth\LoginAction::class)->name('login');
        Route::match([ 'GET', 'POST' ], 'register', \App\Http\Controllers\Frontend\Actions\Auth\RegisterAction::class)->name('register');
        Route::match([ 'GET', 'POST' ], 'password/reset', \App\Http\Controllers\Frontend\Actions\Auth\ResetAction::class)->name('reset-password');
    });
});
