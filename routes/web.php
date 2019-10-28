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
/*
Route::get('/', function () {
    // 初期設定
    return view('home');
});*/

Route::get('sample', function () {
    // Hello world
    return view('sample');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//追記
Route::get('/', function () {
    
    return view('/home/home');
});

Route::get('/home', function () {
    
    return view('/home/home');
});

// 変更　laravelに標準搭載のAuth::routes()を使う
// 下記のviewファイルはAuthの下のlogin.blade.phpとregister.blade.phpの中にコピーする
// Route::get('/sign_in', function () {
    
//     return view('/sign_in/sign_in');
// });

// Route::get('/register', function () {
    
//     return view('/sign_in/register');
// });



Route::get('/search', function () {
    
    return view('/search/search');
});
Route::get('/search/result', function () {
    
    return view('/search/search-result');
});

// 10/28追記（清水）
Route::resource('posts', 'PostsController');
Route::resource('schedules', 'SchedulesController');
Route::resource('chats', 'ChatsController');
Route::resource('messages', 'MessagesController');

