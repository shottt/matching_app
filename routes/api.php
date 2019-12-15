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
    //Auth::routes();
    //
    //from name, password
    //return  user_id, result_flag;
    //
    
    Auth::routes();

    //1209 カラム名が変わっていたのでその変更に合わせてコメントを修正
    //settings フォルダ
    // from  user_id, 
    //       
    //         name,
    //         occupation,
    //         birthday,
    //         profile_header,
    //         profile_detail,
    //         picture,

    // return result_flag, 
    //        my_data {}
    Route::post('/ctrl_set_prof', 'Api\UsersController@set_prof');

    //settings フォルダ
    // from  picture,
    // return result_flag, 
    //        picture
    Route::post('/ctrl_set_prof_img', 'Api\UsersController@set_prof_img');

    // Route::group(['middleware' => ['auth']], function () {
    //         // この中はログインされている場合のみルーティングされる
    //         Route::get('/ctrl_set_prof', 'Ajax\UsersController@set_prof');
    //   });
    
    // from user_id,pass_now,pass_new
    // return result_flag
    Route::post('/ctrl_change_pass', 'Ajax\UsersController@change_pass');

    // from user_id,
    // return result_flag  
    Route::post('/ctrl_sign_out', function (Request $request) {
        Auth::logout();
    });

    // from user_id,
    // return result_flag
    Route::post('/ctrl_unsubscription', function (Request $request) {
        //user_idを受け取って、コントローラ通してレコード論理削除
   
        //return view('/home/home');
    });

    
    // 自分自身以外のユーザー情報を全てげっと
    // from user_id,
    // return result_flag, 
    //        friends:
    //          id,
    //          picture,
    //          name,
    //          occupation
    

    // Route::post('/ctrl_all_friends', function () {

    //     //検索のコントローラに投げる
    //     //return view('/home/home');
    // });

   
    // 画像アップロード用のルーティング（テスト用に配置）
    Route::get('/picture', 'Api\UsersController@index');
    Route::post('/picture', 'Api\UsersController@store');

    /***********************************
     * 登録ユーザー検索
    ***********************************/

    /**自分以外の全ユーザー検索
     * from user_id,
     * return friends: [
     * [id,picture,name, occupation]
     * [id,picture,name, occupation]
     * [id,picture,name, occupation]
     * ],
     * result_flag;
     */
    Route::post('/ctrl_all_users', 'Api\UsersController@user_search');
    // 簡易確認用にgetのルーティングを配置
    // Route::get('/ctrl_all_users', 'Api\UsersController@user_search');


    /**自分以外の全ユーザーを条件付きで検索
     * from user_id, search_query=>[String, String ...String]
     * return friends: [
     * [id,picture,name, occupation]
     * [id,picture,name, occupation]
     * [id,picture,name, occupation]
     * ],
     * result_flag;
     */
    //Route::post('/ctrl_search_users', '');

    /**自分の友達一覧表示
     * from user_id,
     * return friends: [
     * [id,picture,name, occupation]
     * [id,picture,name, occupation]
     * [id,picture,name, occupation]
     * ],
     * result_flag;  
     */
    Route::post('/ctrl_all_friends', 'Api\UsersController@friend_search');
    

    /***********************************
     * 登録ユーザー詳細機能
    ***********************************/
    /* どのユーザーの詳細もとってこれるようにする
    * ただし、ログインユーザーか他のユーザーかの識別は必要
    * from user_id, 
    * return result_flag;
    *        friend:
    *               id,
    *               picture,
    *               name,
    *               occupation
    */
    Route::post('/ctrl_user_profile', 'Api\UsersController@user_profile');


    /***********************************
     * メッセージ機能
    ***********************************/

    /* チャットコメントを取得する
    * 
    * from my_id, user_id, puls_recore
    * return result_flag;
    *        comments:
    *               id,
    *               detail,
    *               user_id,
    *               attachment
    *               updated_at,
    */
    Route::post('/ctrl_get_chat', 'Api\ChatsController@get_chat');


    /* 最新コメント取得
    * 
    * from chat_id
    * return result_flag;
    *        comment:
    *               id,
    *               detail,
    *               user_id,
    *               attachment
    *               updated_at,
    */
    Route::post('/ctrl_get_new_chat', 'Api\ChatsController@get_new_chat');

    /* チャットコメントを追加する
    * 
    * from my_id, user_id, comment, chat_id
    * return result_flag;
    */
    Route::post('/ctrl_add_chat_comment', 'Api\ChatsController@add_chat_comment');

    /* chat作成　※Api\ChatsController@get_chat　リダイアレクトでも使えるように
    * from my_id, user_id
    * return result_flag;
    *        comments:
    *               id,
    *               detail,
    *               user_id,
    *               attachment
    *               updated_at,
    */
    Route::post('/create_chat', 'Api\ChatsController@get_chat');

});
