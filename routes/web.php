<?php

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

$lang = config('user_prefered_locale');

Route::redirect('/', 'messages');
Route::redirect($lang, $lang.'/messages');

Route::get('bulletin/{year?}/{month?}', 'BulletinController@index')->name('bulletin.index');

Route::group(['prefix' => $lang], function () {
    $directory  = __('nav.directory.url');

    Route::get('messages/{message}/download', function (App\Message $message) {
        $path = "audio/{$message->filename}.mp3";
        $size = Storage::size($path);
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="'.$message->title.'.mp3"');
        header('Content-Type: audio/mpeg');
        header('Content-Length: '.$size);
        return readfile(ltrim(Storage::url($path), '/'));
    });

    Route::resource('messages', 'MessagesController');


    Route::get('contact', 'ContactController@index')->name('contact.index');

    Route::post('contact', 'ContactController@send');


    Route::get(__('nav.beliefs.url'), 'BeliefsController@index')->name('beliefs.index');

    Route::get('chants/ajouter', 'SongsController@create');
    Route::post('chants', 'SongsController@store');
    Route::get('recherche-chants', 'SongsController@search');

    Route::get('cultes/ajouter', 'ServiceController@create');
    Route::post('cultes', 'ServiceController@store');


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

    // Authentication...
    if (config('fortify.views', true)) {
        Route::get(__('nav.login.url'), [AuthenticatedSessionController::class, 'create'])
            ->middleware(['guest:'.config('fortify.guard')])
            ->name('login');
    }

    $limiter = config('fortify.limiters.login');

    Route::post(__('nav.login.url'), [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:'.config('fortify.guard'),
            $limiter ? 'throttle:'.$limiter : null,
        ]));

    Route::post(__('nav.logout.url'), [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
