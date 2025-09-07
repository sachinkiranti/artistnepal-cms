<?php

Route::namespace('App\Http\Controllers\Frontend')->middleware([ 'web', ])->group(function () {

    Route::get('/', 'HomeController')->name('home');

    Route::post('/feedback', 'Actions\FeedbackReaction')->name('feedback');

    Route::get('/customizer', 'CustomizerController')
        ->name('customizer.single')
        ->middleware('auth');

    Route::get('/detail/{slug}.html', 'SingleController')->name('post.single');

    Route::get('/detail/{slug}.html/customizer', 'SingleCustomizerController')
        ->name('post.single.customizer')
        ->middleware('auth');

    Route::post('/post/load-more-data', 'LoadMoreDataController')->name('post.load-more-data');

    Route::get('/author/{author}', 'AuthorController')->name('author.single');

    Route::get('/page/{slug}', 'PageController')->name('page.single');

    Route::get('/news-for/{slug}.html', 'ArchiveController')->name('archive');

    Route::get('/gallery/{slug?}', 'GalleryController')->name('gallery');

    Route::post('/feedback/reaction', 'Actions\ReactionAction')
        ->name('feedback.reaction')
        ->middleware('nep.ajax');

    Route::get('news/rss', 'Actions\RssNewsAction')->name('news.rss');

});

Route::feeds();
