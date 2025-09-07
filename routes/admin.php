<?php

Route::get('dashboard', 'DashboardController')->name('dashboard.index');

Route::get('menu', 'Appearance\MenuController')->name('menu.index');

Route::get('quick-settings/{pattern}/{value?}', 'Actions\QuickSettingAction')->name('quick-settings');

Route::group([ 'namespace' => 'Appearance', 'prefix' => 'customizer' ], function () {

    Route::get('/', 'CustomizerController')
        ->name('customizer.index');

    Route::get('{component}', 'WidgetController')
        ->name('customizer.edit');

    Route::get('{component}/advertisement/{widget}', 'AdvertisementController@index')
        ->name('advertisement.edit');

    Route::post('advertisement/update', 'AdvertisementController@save')
        ->name('advertisement.save');

});

Route::get('/comment', 'CommentController@index')->name('comment.index');
Route::get('/reaction', 'ReactionController@index')->name('reaction.index');
Route::post('/comment', 'Actions\CommentAction')->name('actions.comment');

Route::group([ 'prefix' => '{model}/actions', ], function () {

    Route::post('/delete', 'Actions\DeleteBulkAction')->name('actions.delete');

    Route::post('/active-status', 'Actions\ActiveBulkAction')->name('actions.active');

    Route::post('/inactive-status', 'Actions\InActiveBulkAction')->name('actions.inactive');

    Route::post('/status', 'Actions\StatusAction')->name('actions.status');

    Route::post('/count', 'Actions\CountAction')->name('action.count');

});

Route::delete('user/restore/{user}', 'UserActionController@restore')->name('user.restore');
Route::delete('user/force-delete/{user}', 'UserActionController@forceDelete')->name('user.force-delete');

Route::resource('tag', 'TagController');

Route::resource('user', 'UserController');

Route::group([ 'prefix' => 'user-type/{role}', ], function () {

    Route::get('/', 'UserTypeController@index')->name('user-type.index');

    Route::post('/', 'UserTypeController@store')->name('user-type.store');

    Route::get('/create', 'UserTypeController@create')->name('user-type.create');

    Route::get('/{user}', 'UserTypeController@show')->name('user-type.show');

    Route::match(['put', 'patch'], '{user}','UserTypeController@update')->name('user-type.update');

    Route::delete('/{user}', 'UserTypeController@destroy')->name('user-type.destroy');

    Route::get('/{user}/edit', 'UserTypeController@edit')->name('user-type.edit');

});

Route::resource('faq', 'FaqController');

Route::get('category/summary', ['as' => 'category.summary', 'uses' => 'CategoryController@summary']);

Route::resource('category', 'CategoryController');

Route::post('post/sub-category', ['as' => 'post.sub-category', 'uses' => 'PostController@renderSubCategory']);
Route::resource('post', 'PostController');

Route::get('team', 'TeamController@edit')->name('team.edit');
Route::post('team', 'TeamController@update')->name('team.update');

Route::get('setting', 'SettingController@edit')->name('setting.edit');
Route::post('setting', 'SettingController@update')->name('setting.update');

Route::get('profile/{user}', 'ProfileController@edit')->name('profile.edit');
Route::Post('profile/{user}', 'ProfileController@update')->name('profile.update');

Route::resource('role', 'RoleController');
Route::get('role/{role}/permissions', 'RoleController@getPermissionsForRole')->name('role.permissions');
Route::resource('permission', 'PermissionController');

Route::resource('email-template', 'EmailTemplateController')->only('index', 'edit', 'update');
Route::get('email-pattern', 'EmailPatternController')->name('email-pattern.index');

Route::resource('gallery', 'GalleryController');

Route::group([ 'namespace' => 'Appearance\Actions\Widgets', 'middleware' => 'nep.ajax', ], function () {

    Route::post('get-widget-form', 'RenderWidget')->name('render.widget');

    Route::post('save-widget',    'SaveWidget')->name('save.widget');

    Route::post('delete-widget',   'DeleteWidget')->name('delete.widget');

    Route::post('get-entity-items', 'RenderEntityItems')->name('render.entity-items');

    Route::post('edit-widget/{id}', 'EditWidget')->name('edit.widget');

    Route::post('update-widget/{id}', 'UpdateWidget')->name('update.widget');

    Route::post('widget/preview', 'WidgetPreviewAction')->name('widget.preview');

});

Route::group([ 'namespace' => 'Appearance\Actions\Wrappers', ], function () {

    Route::get('wrapper', 'WrapperAction')->name('wrapper.index');

    Route::post('wrapper',    'SortWrapperAction')->name('wrapper.save');

});

Route::group([ 'namespace' => 'Appearance\Actions\Menus', ], function () {

    Route::post('get-menu-form', 'RenderMenu')->name('render.menu');

    Route::post('save-menu','SaveMenu')->name('save.menu');

});
