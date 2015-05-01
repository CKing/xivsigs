<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'index',
    'uses' => 'PagesController@index'
]);

Route::get('/char/{id}/{name?}', [
    'as' => 'char',
    'uses' => 'PagesController@char'
]);

Route::get('/img/{type}/{id}/{size}.png', [
    'as' => 'img',
    'uses' => 'PagesController@image'
]);

Route::get('/sig/{id}/{name?}.png', [
    'as' => 'signature',
    'uses' => 'PagesController@signature'
]);

Route::get('/search-char', [
    'as' => 'ajax.lodestone',
    'uses' => 'AjaxController@char'
]);
