<?php

Route::get('/', function () {
    return redirect('/app');
});

Route::get('/app/{vue_capture?}', function () {
    return view('vue.index');
})->where('vue_capture', '[\/\w\.-]*');

//Route::get('/{name}', function () {
//    return redirect('/');
//})->where('name', '[A-Za-z\-]*');

Route::prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Classifications
    Route::get('/classifications', 'ClassificationController@index')->name('classifications');
    Route::get('/classifications/{id}', 'ClassificationController@edit')->name('classifications.edit');
    Route::post('/classifications', 'ClassificationController@store')->name('classifications.store');
    Route::put('/classifications/{id}', 'ClassificationController@update')->name('classifications.update');
    Route::put('/classifications/{id}/update_publish', 'ClassificationController@updatePublishedStatus')->name('classifications.publish');

    // Classification Entities
    Route::get('/classifications/{classificationId}/entities', 'EntityController@index')->name('entities');

    // Classification Facets
    Route::get('/classifications/{classificationId}/facets', 'FacetController@index')->name('facets');

    // Entities
    Route::get('/entities/{id}', 'EntityController@edit')->name('entities.edit');

    // Facets
    Route::get('/facets/{id}', 'FacetController@edit')->name('facets.edit');

    // Users
    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/users/{id}', 'UserController@edit')->name('users.edit');
    Route::post('/users', 'UserController@store')->name('users.store');
    Route::put('/users/{id}', 'UserController@update')->name('users.update');
    Route::delete('/users/{id}', 'UserController@destroy')->name('users.delete');

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
});
