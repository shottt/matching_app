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

    /*
    from name, pass
    return  user_id, result_flag;
    */
    Route::post('/ctrl_sign_in', 'Ajax\UsersController@show');

    /*
    from
        name,
        location,
        email,
        pass
    return user_id, result_flag
    */
    Route::post('/ctrl_registration','Ajax\UsersController@store');

    //友達検索
    Route::post('/ctrl_search_for_frends', function () {

        //検索のコントローラに投げる
        //return view('/home/home');
    });

    //settings フォルダ
    /*
    from user_id, object: prof_data
    return result_flag
    */
    Route::post('/ctrl_set_prof', 'Ajax\UsersController@set_prof');

    /*
    from user_id,pass_now,pass_new
    return result_flag
    */
    Route::post('/ctrl_change_pass', 'Ajax\UsersController@change_pass');

    /*
    from user_id,
    return result_flag
    */
    Route::post('/ctrl_sign_out', function (Request $request) {

        $email = $request->input('email');
        $pass = $request->input('pass');
  
        return response()->json(['email' => $email, 'pass' => $pass]);
    });

    /*
    from user_id,
    return result_flag
    */
    Route::post('/ctrl_unsubscription', function (Request $request) {
        //user_idを受け取って、コントローラ通してレコード論理削除
   
        //return view('/home/home');
    });
    
});