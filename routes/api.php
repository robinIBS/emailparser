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

Route::post('add_inbox','RestController@add_inbox');
Route::post('keyword','RestController@keyword');
Route::post('keyword_group','RestController@keyword_group');
Route::any('search_emails','RestController@search_emails');

Route::get('list_inbox/{user_id}',['uses'=>'RestController@list_inbox']);
Route::get('view/{ID}',['uses'=>'RestController@view']);
Route::get('get_rule_view/{view}',['uses'=>'RestController@get_rule_view']);


Route::any('elastic_create','RestController@elastic_create')->middleware('checkToken');;


Route::post('search_messages',['uses'=>'RestController@search_messages'])->middleware('checkToken');;
