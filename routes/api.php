<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function() {

    //サインイン axios経由
    
    Route::get('/ctrl_sign_in', function (Request $request) {
        var_dump("ルーティング");
        var_dump($request);
       
        //サインインのコントローラに投げる
        return view('/index');
    });

    //登録 axios経由
    Route::post('/ctrl_registration', function () {

        //登録のコントローラに投げる
        //return view('/home/home');
    });

    //友達検索 axios経由
    Route::post('/ctrl_search_for_frends', function () {

        //検索のコントローラに投げる
        //return view('/home/home');
    });

    
    Route::post('/ctrl_change_pass', function () {

   
        //return view('/home/home');
    });

    Route::get('/ctrl_change_pass', function () {

   
        //return view('/home/home');
    });
    
});