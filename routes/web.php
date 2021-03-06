<?php

use Illuminate\Http\Request;

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

// Auth::logout();
Route::get('/', function(){
    return view('welcome');
});

Auth::routes();

//初期レンダリング
//あとは api.phpに記述
//ログインのセッションかクッキーを判定して、
//trueなら、Homeを描画できるようにする

Route::get('/{any}', function (Request $request) {
    return view('/index');
})->where('any', '.*');

// laravelのみの処理
Route::group(['middleware' => ['auth']], function(){
    Route::resource('posts', 'PostsController');
    Route::resource('schedules', 'SchedulesController');
    Route::resource('chats', 'ChatsController');
    Route::resource('comments', 'CommentsController');
    Route::resource('friends', 'FriendsController');
});




/*

Route::get('/home', 'HomeController@index')->name('home');

//追記
Route::get('/', function () {
    
    return view('/home/home');
});

Route::get('/home', function () {
    
    return view('/home/home');
});

// Route::get('/sign_in', function () {
    
//     return view('/sign_in/sign_in');
// });

// Route::get('/register', function () {
    
//     return view('/sign_in/register');
// });

*/