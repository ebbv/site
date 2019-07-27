<?php

$directory  = __('nav.directory.url');

Route::redirect('/', 'messages');

Route::resource('messages', 'MessagesController');


Route::get('contact', 'ContactController@index')->name('contact.index');


Route::get(__('nav.beliefs.url'), 'BeliefsController@index')->name('beliefs.index');


Route::get($directory, 'DirectoryController@index')
    ->name('directory.index');

Route::get($directory.'/'.__('nav.actions.add'), 'DirectoryController@create')
    ->name('directory.create');

Route::post($directory, 'DirectoryController@store')
    ->name('directory.store');

Route::get($directory.'/{user}/'.__('nav.actions.edit'), 'DirectoryController@edit')
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
