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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
