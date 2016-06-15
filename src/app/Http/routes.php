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
Route::get('message/ajouter', 'MessageController@create');
Route::post('message', 'MessageController@store');
Route::get('contact', 'ContactController@index');
Route::post('contact', 'ContactController@send');
Route::get('connexion', 'AuthController@login');
Route::post('connexion', 'AuthController@verify');
Route::get('déconnexion', 'AuthController@logout');
Route::get('annuaire', 'DirectoryController@index');
Route::get('annuaire/ajouter', 'DirectoryController@create');
Route::get('annuaire/modifier/{id}', 'DirectoryController@edit')->where('id', '[0-9]+');
Route::get('annuaire/supprimer/{id}', 'DirectoryController@destroy')->where('id', '[0-9]+');
Route::post('annuaire', 'DirectoryController@store');


View::creator(Config::get('app.theme'), function($view) {
  $view->with('theme', str_replace('master', '', Config::get('app.theme')));
});
