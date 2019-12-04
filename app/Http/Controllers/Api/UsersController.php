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
        $result_flag = true;

        // 必要なカラムだけ取ってくる、自分のユーザーID以外かつdelete_flagが0のユーザー取って来る
        // $user = User::whereNotIn('id', $auth_id)->get(); → この書き方だとエラー
        // $users = User::where('id', '!=', $auth_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation', 'picture']);
        $users = DB::table('users')->where('id', '!=', $auth_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation', 'picture']);

        // Log::debug(print_r($users, true));

        // 異常判定
        if(empty($users)){
            // ユーザーデータが空の場合はfalseを返す
            return response()->json(['result_flag' => false]);
        }

        // keyをフレンドにする
        // foreach($users as $key => $user){
        //     $userlist_key[] = "frend${key}";
        //     $userlist_val[] = $user;

        //     $userlist = array_combine($userlist_key, $userlist_val);
        // }
        // Log::debug(print_r($userlist, true));

        return response()->json($users);

    }

    //user_searchをコピペしただけ
    //自分のフレンドだけを表示するように書き換える必要あり
    public function friend_search(){
        
        // 自分のユーザーIDを取得
        $auth_id = Auth::id();
        // Log::debug($auth_id);

        // 必要なカラムだけ取ってくる、自分のユーザーID以外かつdelete_flagが0のユーザー取って来る
        // $user = User::whereNotIn('id', $auth_id)->get(); → この書き方だとエラー
        // $users = User::where('id', '!=', $auth_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation', 'picture']);
        $users = DB::table('users')->where('id', '!=', $auth_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation', 'picture']);

        // Log::debug(print_r($users, true));

        // 異常判定
        if(empty($users)){
            // ユーザーデータが空の場合はfalseを返す
            return response()->json(['result_flag' => false]);
        }

        // foreach($users as $key => $user){
        //     $userlist_key[] = "frend${key}";
        //     $userlist_val[] = $user;

        //     $userlist = array_combine($userlist_key, $userlist_val);
        // }
        // Log::debug(print_r($userlist, true));

        return response()->json($users);

    }

    // ユーザー情報詳細（自分以外）を取得する
    public function user_profile(Request $request){
        // 自分のユーザーIDを取得
        $auth_id = Auth::id();
        
        $id = $request->user_id;
        $result_flag = true;
        if(empty($id)){
            $result_flag = false;
            return response()->json(['result_flag' => false]);
        }
        // Log::debug(print_r($request->all()));
        $user = DB::table('users')->where('id', '!=', $auth_id)->where('id', '=', $id)->where('delete_flag', 0)->first();

        // 異常判定
        if(empty($user)){
            return response()->json(['result_flag' => false]);
        }

        return response()->json(['result_flag' => true, 'frend' => $user]);
        

    }
}
