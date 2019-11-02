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

    //サインイン
    Route::post('/ctrl_sign_in', function (Request $request) {

        $email = $request->input('email');
        $pass = $request->input('pass');
        //サインインのコントローラに投げる
        return response()->json(['email' => $email, 'pass' => $pass]);
    });
    //登録
    Route::post('/ctrl_registration', function () {

        //登録のコントローラに投げる
        //return view('/home/home');
    });


    
    //友達検索
    Route::post('/ctrl_search_for_frends', function () {

        //検索のコントローラに投げる
        //return view('/home/home');
    });

    
    //settings 
    Route::post('/ctrl_set_prof', function (Request $request) {
        //プロフィール編集
        //user_idでひっかけてプロフィールを更新
        $user_id = $request->input('user_id');
        $prof_data = $request->input('prof_data');
        
        return response()->json(['user_id' => $user_id, 'prof_data' => $prof_data]);
    });
    Route::post('/ctrl_change_pass', function (Request $request) {

        $user_id = $request->input('user_id');
        $pass_now = $request->input('pass_now');
        $pass_new = $request->input('pass_new');
        
        return response()->json(['user_id' => $user_id, 'pass_now' => $pass_now, 'pass_new' => $pass_new]);
        //return view('/home/home');
    });
    Route::post('/ctrl_sign_out', function (Request $request) {

        $email = $request->input('email');
        $pass = $request->input('pass');
  
        return response()->json(['email' => $email, 'pass' => $pass]);
    });
    Route::post('/ctrl_unsubscription', function (Request $request) {
        //user_idを受け取って、コントローラ通してレコード論理削除
   
        //return view('/home/home');
    });
    
});