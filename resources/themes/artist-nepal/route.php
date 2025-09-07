<?php

use App\Http\Controllers\Frontend\{
    HomeController,
    SingleController,
    AuthorController,
    ArtistController,
    PageController,
    GalleryController,
    Actions\ReactionAction,
    Actions\RssNewsAction
};


Route::group([], function () {
    Route::get('/', HomeController::class)->name('home');

    Route::get('/detail/{slug}.html', SingleController::class)->name('post.single');

    Route::get('/author/{author}', AuthorController::class)->name('author.single');
    Route::get('/artist/{artist}', ArtistController::class)->name('artist.single');

    Route::get('/page/{slug}', PageController::class)->name('page.single');

    Route::get('/gallery/{slug?}', GalleryController::class)->name('gallery');

    Route::post('/feedback/reaction', ReactionAction::class)
        ->name('feedback.reaction')
        ->middleware('nep.ajax');

    Route::get('news/rss', RssNewsAction::class)->name('news.rss');
});
