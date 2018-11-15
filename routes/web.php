<?php

Route::get('/', function () {
    return redirect('/app');
});

Route::get('/app/{vue_capture?}', 'VueController@index')->where('vue_capture', '[\/\w\.-]*');

Route::prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Classifications
    Route::get('/classifications', 'ClassificationController@index')->name('classifications');
    Route::get('/classifications/{id}', 'ClassificationController@edit')->name('classifications.edit');
    Route::post('/classifications', 'ClassificationController@store')->name('classifications.store');
    Route::put('/classifications/{id}', 'ClassificationController@update')->name('classifications.update');
    Route::put('/classifications/{id}/update_publish', 'ClassificationController@updatePublishedStatus')->name('classifications.publish');

    // Classification Entities
    Route::get('/classifications/{classificationId}/entities', 'EntityController@index')->name('classifications.entities');

    // Classification Facets
    Route::get('/classifications/{classificationId}/facets', 'FacetController@index')->name('classifications.facets');

    // Entities
    Route::get('/entities/{classificationId}/{id}', 'EntityController@edit')->name('entities.edit');
    Route::post('/entities', 'EntityController@store')->name('entities.store');
    Route::put('/entities/{id}', 'EntityController@update')->name('entities.update');
    Route::put('/entities/{id}/update_publish', 'EntityController@updatePublishedStatus')->name('entities.publish');

    // Facets
    Route::get('/facets/{classificationId}/{id}', 'FacetController@edit')->name('facets.edit');
    Route::post('/facets', 'FacetController@store')->name('facets.store');
    Route::put('/facets/{id}', 'FacetController@update')->name('facets.update');
    Route::delete('/facets/{id}', 'FacetController@destroy')->name('users.delete');

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
