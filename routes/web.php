<?php


/**
 * AuthController
 */
Route::get('/login', 'AuthController@index')->name('login');
Route::post('/login/do', 'AuthController@login')->name('login.do');
Route::get('/login/logout', 'AuthController@logout')->name('logout');


/**
 * TaskController
 */
Route::middleware('auth')->group( function(){
    Route::get('/tasks', 'TaskController@index')->name('home');
    Route::post('/task/store', 'TaskController@store')->name('task.store');
    Route::delete('/task/delete/{id}', 'TaskController@delete')->name('task.delete')->where(['id' => '[0-9]+']);
    route::put('/task/update/{id}', 'TaskController@update')->name('task.update')->where(['id' => '[0-9]+']);
});

