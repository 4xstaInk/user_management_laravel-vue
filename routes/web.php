<?php

use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/post', [App\Http\Controllers\PostController::class, 'page'])->name('post');

Route::prefix('users')->name('users.')->middleware(['web','auth'])->group(function(){
    Route::get('/','App\Http\Controllers\Users\UsersController@index')->name('dashboard');
  //  Route::get('/', [UsersController::class, 'index'])->name('dasboard');
  //   Route::post('/store', [ItemController::class, 'store']);
  
 Route::post('/items','App\Http\Controllers\TaskController@store');
 
 Route::get('/items','App\Http\Controllers\TaskController@index');
});

Route::prefix('accounts')->name('accounts.')->middleware(['web','auth'])->group(function(){
   
Route::get('/', 'App\Http\Controllers\Accounts\UserAccountsController@index')->name('dashboard');

});

Route::prefix('testing')->name('testing.')->middleware(['web','auth'])->group(function(){
    
    Route::get('/', 'App\Http\Controllers\TestingController@index')->name('dashboard');
    
    });

 Route::prefix('data')->middleware(['web','auth'])->group(base_path('routes/web/data.php'));

 //Post Section


 Route::prefix('users')->name('users.')->middleware(['web','auth'])->group(function(){

 Route::post('/post','App\Http\Controllers\PostController@store');

 Route::get('/post/list','App\Http\Controllers\PostController@showPosts');
 
});
