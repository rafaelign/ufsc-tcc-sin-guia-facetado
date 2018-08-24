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

Route::get('collections/{slug}/entities', 'EntityController@getByCollectionSlug');

Route::post('collections/{slug}/entities', 'EntityController@getByCollectionSlug');

Route::get('collections/{slug}/facets', 'CollectionController@getFacetsByCollectionSlug');

Route::get('entities/{slug}', 'EntityController@getBySlug');

Route::get('entities/{slug}/values', 'EntityController@getValuesByEntitySlug');

Route::put('entities/page_views/{id}', 'EntityController@addPageView');

Route::get('facet_groups/{collectionSlug}', 'FacetGroupController@getFacetGroupsByCollectionSlug');
