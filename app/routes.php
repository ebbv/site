<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'MessagesController@index');


Route::get('messages.html', array(
    'as'    => 'messages.index',
    'uses'  => 'MessagesController@index'
));

View::creator(Config::get('app.theme'), function($view)
{
    $view->with('theme', str_replace('master', '', Config::get('app.theme')));
});