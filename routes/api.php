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
    
    /* 友達検索（自分自身以外のユーザー情報を全てげっと）
   from user_id,
   return result_flag,
          frends:
            id,
            picture,
            name,
            occupation
   */
    Route::post('/ctrl_all_frends', 'Api\UsersController@friend_search');
    // 簡易確認用にgetのルーティングを配置
    Route::get('/ctrl_all_frends', 'Api\UsersController@friend_search');
   
    // 画像アップロード用のルーティング（テスト用に配置）
    Route::get('/picture', 'Api\UsersController@index');
    Route::post('/picture', 'Api\UsersController@store');
});

