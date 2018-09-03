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

    Route::get('/classifications', 'ClassificationController@index')->name('classifications');
    Route::put('/classifications/{id}/update_publish', 'ClassificationController@updatePublishedStatus')->name('classifications.publish');

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
