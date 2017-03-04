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

Route::resourceVerbs([
    'create' => __('nav.actions.add'),
    'edit' => __('nav.actions.edit'),
]);

Route::get('/', 'MessagesController@index');
Route::resource('messages', 'MessagesController');
Route::resource(__('nav.directory.url'), 'DirectoryController');
Route::get(__('nav.contact.url'), 'ContactController@index');
Route::post(__('nav.contact.url'), 'ContactController@send');
Route::get(__('nav.login.url'), 'AuthController@login');
Route::post(__('nav.login.url'), 'AuthController@verify');
Route::get(__('nav.logout.url'), 'AuthController@logout');
Route::get(__('nav.beliefs.url'), 'BeliefsController@index');
Route::get('error', 'ErrorsController@index');
