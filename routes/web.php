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

$add        = __('nav.actions.add');
$edit       = __('nav.actions.edit');
$directory  = __('nav.directory.url');

Route::get('/', function () {
    return redirect('messages');
});

Route::get('messages', 'MessagesController@index')->name('messages.index');
Route::get('messages/{message}', 'MessagesController@show')->name('messages.show')->where('message', '[0-9]+');
Route::get('messages/'.$add, 'MessagesController@create')->name('messages.create');
Route::post('messages', 'MessagesController@store')->name('messages.store');
Route::get('messages/{message}/'.$edit, 'MessagesController@edit')->name('messages.edit')->where('message', '[0-9]+');
Route::match(['put', 'patch'], 'messages/{message}', 'MessagesController@update')->name('messages.update')->where('message', '[0-9]+');
Route::delete('messages/{message}', 'MessagesController@destroy')->name('messages.destroy')->where('message', '[0-9]+');

Route::get($directory, 'DirectoryController@index')->name('directory.index');
Route::get($directory.'/{member}', 'DirectoryController@show')->name('directory.show')->where('member', '[0-9]+');
Route::get($directory.'/'.$add, 'DirectoryController@create')->name('directory.create');
Route::post($directory, 'DirectoryController@store')->name('directory.store');
Route::get($directory.'/{member}/'.$edit, 'DirectoryController@edit')->name('directory.edit')->where('member', '[0-9]+');
Route::match(['put', 'patch'], $directory.'/{member}', 'DirectoryController@update')->name('directory.update')->where('member', '[0-9]+');
Route::delete($directory.'/{member}', 'DirectoryController@destroy')->name('directory.destroy')->where('member', '[0-9]+');

Route::get(__('nav.contact.url'), 'ContactController@index');
Route::post(__('nav.contact.url'), 'ContactController@send');

Route::get(__('nav.login.url'), 'AuthController@login');
Route::post(__('nav.login.url'), 'AuthController@verify');
Route::get(__('nav.logout.url'), 'AuthController@logout');

Route::get(__('nav.beliefs.url'), 'BeliefsController@index');

Route::get('error', 'ErrorsController@index');
