<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('collections', 'CollectionController@index');
Route::get('collections/{slug}', 'CollectionController@getCollectionBySlug');
Route::get('collections/{slug}/entities', 'CollectionController@getEntitiesByCollectionSlug');
Route::get('collections/{slug}/facets', 'CollectionController@getFacetsByCollectionSlug');

Route::get('entities/{slug}', 'EntityController@getEntityBySlug');