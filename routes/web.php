<?php

$add        = __('nav.actions.add');
$edit       = __('nav.actions.edit');
$directory  = __('nav.directory.url');

Route::redirect('/', 'messages');


Route::get('messages', 'MessagesController@index')
    ->name('messages.index');

Route::get('message/{message}', 'MessagesController@show')
    ->name('message.show')
    ->where('message', '[0-9]+');

Route::get('message/'.$add, 'MessagesController@create')
    ->name('message.create');

Route::post('message', 'MessagesController@store')
    ->name('message.store');

Route::get('message/{message}/'.$edit, 'MessagesController@edit')
    ->name('message.edit')
    ->where('message', '[0-9]+');

Route::match(['put', 'patch'], 'message/{message}', 'MessagesController@update')
    ->name('message.update')
    ->where('message', '[0-9]+');

Route::delete('message/{message}', 'MessagesController@destroy')
    ->name('message.destroy')
    ->where('message', '[0-9]+');


Route::get('contact', 'ContactController@index')->name('contact.index');


Route::get(__('nav.beliefs.url'), 'BeliefsController@index')->name('beliefs.index');


Route::get($directory, 'DirectoryController@index')
    ->name('directory.index');

Route::get($directory.'/'.$add, 'DirectoryController@create')
    ->name('directory.create');

Route::post($directory, 'DirectoryController@store')
    ->name('directory.store');

Route::get($directory.'/{user}/'.$edit, 'DirectoryController@edit')
    ->name('directory.edit')
    ->where('user', '[0-9]+');

Route::match(['put', 'patch'], $directory.'/{user}', 'DirectoryController@update')
    ->name('directory.update')
    ->where('user', '[0-9]+');

Route::delete($directory.'/{user}', 'DirectoryController@destroy')
    ->name('directory.destroy')
    ->where('user', '[0-9]+');


Route::get(__('nav.login.url'), 'Auth\LoginController@showLoginForm')->name('login');
Route::post(__('nav.login.url'), 'Auth\LoginController@login');
Route::post(__('nav.logout.url'), 'Auth\LoginController@logout')->name('logout');
