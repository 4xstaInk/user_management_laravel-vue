<?php
/**
 * prefix:data
 * namespace: Data
 * 
 */
Route::prefix('accounts')->group(function(){
    Route::get('user/{user?}','App\Http\Controllers\Data\Accounts\UserAccountController@index');

    Route::prefix('updates')->group(function(){
        Route::put('email/{user}','App\Http\Controllers\Data\Accounts\Updates\EmailUpdatesController@update');
        Route::put('name/{user}','App\Http\Controllers\Data\Accounts\Updates\NameUpdatesController@update');
    });
});



/**
 * 
 */

Route::prefix('users')->group(function(){

Route::prefix('logs')->group(function(){
    Route::get('{user}', 'App\Http\Controllers\Data\Users\Logs\UserLogsController@index');
});

Route::prefix('updates')->group(function(){
    Route::put('password/{user}', 'App\Http\Controllers\Data\Users\UpdatePasswordsController@update');

    Route::post('send-reset-link/{user}', 'App\Http\Controllers\Data\Users\UpdatePasswordsController@sendResetLink');
});

Route::get('/','App\Http\Controllers\Data\Users\UsersController@index');

/** User Store Route */
 Route::post('/','App\Http\Controllers\Data\Users\UsersController@store');

 /** User Delete Route */
 Route::delete('{user}','App\Http\Controllers\Data\Users\UsersController@destroy');

 /** User Update Route */
 Route::put('{user}','App\Http\Controllers\Data\Users\UsersController@update');
 
});
 
 ?>