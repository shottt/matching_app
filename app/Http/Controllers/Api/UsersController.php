<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Log;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function user_search(){
        
        // 自分のユーザーIDを取得
        $auth_id = Auth::id();
        // Log::debug($auth_id);

        // 必要なカラムだけ取ってくる、自分のユーザーID以外かつdelete_flagが0のユーザー取って来る
        // $user = User::whereNotIn('id', $auth_id)->get(); → この書き方だとエラー
        // $users = User::where('id', '!=', $auth_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation', 'picture']);
        $users = DB::table('users')->where('id', '!=', $auth_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation', 'picture']);
        Log::debug('ユーザー情報一覧：' .print_r($users, true));

        // 異常判定
        if(empty($users)){
            // ユーザーデータが空の場合はfalseを返す
            return response()->json(['result_flag' => false]);
        }
        
        // keyをフレンドにする
        // foreach($users as $key => $user){
        //     $userlist_key[] = "friend${key}";
        //     $userlist_val[] = $user;

        //     $userlist = array_combine($userlist_key, $userlist_val);
        // }
        
        // Log::debug('jsonレスポンス内容：' .response()->json(['result_flag' => true, 'friends' => $users]));
        return response()->json(['result_flag' => true, 'friends' => $users]);

        }

    //1206 user_idを判定に組み込んだ
    //user_searchをコピペしただけ
    //自分のフレンドだけを表示するように書き換える必要あり
    public function friend_search(Request $request){
        
        // 自分のユーザーIDを取得
        //$auth_id = Auth::id();
        // Log::debug($auth_id);

        // 必要なカラムだけ取ってくる、自分のユーザーID以外かつdelete_flagが0のユーザー取って来る
        // $user = User::whereNotIn('id', $auth_id)->get(); → この書き方だとエラー
        // $users = User::where('id', '!=', $auth_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation', 'picture']);
        $users = DB::table('users')->where('id', '!=',  $request->user_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation', 'picture']);

        // Log::debug(print_r($users, true));

        // 異常判定
        if(empty($users)){
            // ユーザーデータが空の場合はfalseを返す
            return response()->json(['result_flag' => false]);
        }

        // foreach($users as $key => $user){
        //     $userlist_key[] = "friend${key}";
        //     $userlist_val[] = $user;

        //     $userlist = array_combine($userlist_key, $userlist_val);
        // }
        // Log::debug(print_r($userlist, true));

        return response()->json(['result_flag' => true, 'friends' => $users]);

    }

    // ユーザー情報詳細（自分以外）を取得する
    public function user_profile(Request $request){
        
        // 自分のユーザーIDを取得
        $auth_id = Auth::id();
        
        $user_id = $request->user_id;
        
        if(empty($user_id)){
            return response()->json(['result_flag' => false]);
        }
        
        $user = DB::table('users')->where('id', '!=', $auth_id)->where('id', '=', $user_id)->where('delete_flag', 0)->first();
        // Log::debug('自分のユーザー情報：' .print_r($user, true));

        // 異常判定
        if(empty($user)){
            return response()->json(['result_flag' => false]);
        }

        // Log::debug('jsonレスポンス内容：' .response()->json(['result_flag' => true, 'friend' => $user]));
        return response()->json(['result_flag' => true, 'friend' => $user]);

    }

    // ユーザー情報を更新する　仮でかいた
    public function set_prof(Request $request){
    
        // 自分のユーザーとPOST値のUser_idを比較

        Log::debug($request);

        // バリデーション
        // $this->validate($request, User::$rules);

        $id = $request->id;

        // idが数字かどうかをチェックする
        if(!ctype_digit($id)){
            return response()->json(['result_flag' => false]);
        }

        // 編集するユーザー情報を取得する
        $user = User::find($id);
        $form = $request->all();
        // fillメソッドで一括保存
        $user->fill($form)->save();

        // $auth_id = Auth::id();
        // $user_id = $request->user_id;
        
        // if(empty($user_id)){
        //     return response()->json(['result_flag' => false]);
        // }
        
        // //update 

        // //select * from users where user_id = user_id;
        // $user = DB::table('users')->where('id', '=', $user_id)->where('delete_flag', 0)->first();
        // // Log::debug(print_r($user, true));

        // // 異常判定
        // if(empty($user)){
        //     return response()->json(['result_flag' => false]);
        // }

        // // Log::debug(response()->json(['result_flag' => true, 'friend' => $user]));
        return response()->json(['result_flag' => true]);

    }

    //set_prof_img
    public function set_prof_img(Request $request){
    
        // 自分のユーザーとPOST値のUser_idを比較

        Log::debug($request->picture);
        Log::debug($request);

        return response()->json(['result_flag' => true]);

    }
}

