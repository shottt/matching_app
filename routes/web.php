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


Auth::routes();

//初期レンダリング
//あとは api.phpに記述
//ログインのセッションかクッキーを判定して、
//trueなら、Homeを描画できるようにする

Route::get('/{any}', function (Request $request) {
   
    return view('/index');
})->where('any', '.*');


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



Route::get('/search', function () {
    
    return view('/search/search');
});
Route::get('/search/result', function () {
    
    return view('/search/search-result');
});

//Vue組み混みver
Route::get('/vue/sign_in', function () {
    
    return view('/sign_in_vue/sign_in');
});
/*
Route::get('/', function () {
    
    return view('/index');
});*/

// 10/28追記（清水）
Route::group(['middleware' => ['auth']], function(){
    Route::resource('posts', 'PostsController');
    Route::resource('schedules', 'SchedulesController');
    Route::resource('chats', 'ChatsController');
    Route::resource('messages', 'MessagesController');
    Route::resource('friends', 'FriendsController');
});

