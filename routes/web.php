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
Route::get('add_rule', ['uses' => 'EmailParserController@add_rule']);
Route::get('emails', ['uses' => 'EmailParserController@emails']);
