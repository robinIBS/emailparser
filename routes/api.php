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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('add_inbox', 'RestController@add_inbox')->middleware('checkToken');
Route::post('keyword', 'RestController@keyword')->middleware('checkToken');
Route::post('keyword_group', 'RestController@keyword_group')->middleware('checkToken');
Route::any('search_emails', 'RestController@search_emails')->middleware('checkToken');

Route::get('list_inbox/{user_id}', ['uses' => 'RestController@list_inbox'])->middleware('checkToken');
Route::get('view/{ID}', ['uses' => 'RestController@view'])->middleware('checkToken');
Route::get('get_rule_view/{view}', ['uses' => 'RestController@get_rule_view'])->middleware('checkToken');


Route::any('elastic_create', 'RestController@elastic_create')->middleware('checkToken');


Route::post('search_messages', ['uses' => 'RestController@search_messages'])->middleware('checkToken');
