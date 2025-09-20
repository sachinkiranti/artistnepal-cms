<?php

Route::get('authorize', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('authorize', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Route::get('/translate/{locale}', 'Actions\LangTranslatorAction')->name('translate');

Route::group(['prefix' => 'media', 'middleware' => [ 'web', 'auth', ]], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();

    Route::get('/manager', 'Admin\Actions\FileManagerAction')
        ->name('admin.media.manager')
        ->prefix('admin');
});

