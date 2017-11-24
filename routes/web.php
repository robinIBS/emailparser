<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});


Route::any('create_inbox', 'EmailParserController@create_inbox');
Route::any('list_inbox', 'EmailParserController@list_inbox');

Route::get('view', ['uses' => 'EmailParserController@view']);
Route::get('create_filter', ['uses' => 'EmailParserController@add_filter']);
Route::get('create_filter_group', ['uses' => 'EmailParserController@add_filter_group']);
Route::get('emails', ['uses' => 'EmailParserController@emails']);
Route::get('notifications', ['uses' => 'EmailParserController@notifications']);

/***Elastic Search ****/
Route::any('elastic_search','ElasticSearchController@elasticSearch');
//Route::any('elastic_create','ElasticSearchController@elasticCreate');
Route::any('search_document','ElasticSearchController@search_document');
Route::any('delete_document','ElasticSearchController@deleteDocument');
Route::any('elastic_search_all','ElasticSearchController@elasticSearchAll');

