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

Route::get('/', 'MessageController@index');
Route::get('message/'.trans('nav.actions.add'), 'MessageController@create');
Route::post('message', 'MessageController@store');
Route::get(trans('nav.contact.url'), 'ContactController@index');
Route::post(trans('nav.contact.url'), 'ContactController@send');
Route::get(trans('nav.login.url'), 'AuthController@login');
Route::post(trans('nav.login.url'), 'AuthController@verify');
Route::get(trans('nav.logout.url'), 'AuthController@logout');
Route::get(trans('nav.directory.url'), 'DirectoryController@index');
Route::get(trans('nav.directory.url').'/'.trans('nav.actions.add'), 'DirectoryController@create');
Route::get(trans('nav.directory.url').'/{member}/'.trans('nav.actions.edit'), 'DirectoryController@edit')->where('member', '[0-9]+');
Route::post(trans('nav.directory.url'), 'DirectoryController@store');
Route::get(trans('nav.beliefs.url'), 'BeliefsController@index');


View::creator(config('app.theme'), function ($view) {
    $view->with('theme', str_replace('master', '', config('app.theme')));
});
