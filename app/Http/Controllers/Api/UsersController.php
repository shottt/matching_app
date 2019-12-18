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
    public function user_search(Request $request){
        
        // 自分のIDを取得する
        $my_id =$request->header('aut_id');
        // ログインユーザーIDと一致しているか確認
        if($my_id != Auth::id()){
            return response()->json(['result_flag' => false]);
        }

        // 必要なカラムだけ取ってくる、自分のユーザーID以外かつdelete_flagが0のユーザー取って来る
        // $user = User::whereNotIn('id', $my_id)->get(); → この書き方だとエラー
        // $users = User::where('id', '!=', $my_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation', 'picture']);
        $users = DB::table('users')->where('id', '!=', $my_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation', 'picture']);
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
        //$my_id = Auth::id();
        // Log::debug($my_id);

        // 必要なカラムだけ取ってくる、自分のユーザーID以外かつdelete_flagが0のユーザー取って来る
        // $user = User::whereNotIn('id', $my_id)->get(); → この書き方だとエラー
        // $users = User::where('id', '!=', $my_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation', 'picture']);
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
        
        // 自分のIDを取得する
        $my_id =$request->header('aut_id');
        // ログインユーザーIDと一致しているか確認
        if($my_id != Auth::id()){
            return response()->json(['result_flag' => false]);
        }
        
        $user_id = $request->user_id;
        
        if(empty($user_id)){
            return response()->json(['result_flag' => false]);
        }
        
        $user = User::where('id', '!=', $my_id)->where('id', $user_id)->where('delete_flag', 0)->first();
        // Log::debug('ユーザー情報詳細：' .print_r($user, true));

        // 異常判定
        if(empty($user)){
            return response()->json(['result_flag' => false]);
        }

        // Log::debug('jsonレスポンス内容：' .response()->json(['result_flag' => true, 'friend' => $user]));
        return response()->json(['result_flag' => true, 'friend' => $user]);

    }

    // ユーザー情報を更新する
    public function set_prof(Request $request){

        // バリデーション
        $this->validate($request, User::$rules);
        // Log::debug('バリデーションOK');

         // my_dataを変数に格納
         $my_data = $request->my_data;
        //  Log::debug($my_data);

        // 自分のIDを取得する
        $my_id =$request->header('aut_id');
        // ログインユーザーIDと一致しているか確認
        if($my_id != Auth::id()){
            return response()->json(['result_flag' => false]);
        }

        // 編集するユーザー情報を取得する
        $user = User::where('id', $my_id)->where('delete_flag', 0)->first();

        // 異常判定
        if(empty($user)){
            return response()->json(['result_flag' => false]);
        }
        // 受け取ったmy_dataをfillメソッドで保存する
        $result = $user->fill($my_data)->save();

        // 結果がfalseの場合、result_flagをfalseでreturn
        if(!$result){
            return response()->json(['result_flag' => false]);
        }

        // 更新後のユーザー情報を取得する
        $my_data = User::where('id', $my_id)->where('delete_flag', 0)->first();

        // Log::debug(response()->json(['result_flag' => true, 'my_data' => $my_data]));
        return response()->json(['result_flag' => true, 'my_data' => $my_data]);

    }

    //set_prof_img
    public function set_prof_img(Request $request){
    
        Log::debug($request);
        // バリデーション
        $this->validate($request, User::$rules);

        // 自分のIDを取得する
        $my_id =$request->header('aut_id');

        // ログインユーザーIDと一致しているか確認
        // if($my_id != Auth::id()){
        //     return response()->json(['result_flag' => false]);
        // }
        $uploadImg =$request->picture;
        Log::debug($uploadImg);

        // アップロードに成功している確認し、ファイルパスに保存
        if($uploadImg->isValid()){
            $filePath = $uploadImg->store('public');
            // Log::debug($filePath);
            // 編集するユーザー情報を取得する
            $user = User::where('id', $my_id)->where('delete_flag', 0)->first();

            //$user->picture = str_replace('public/', '', $filePath);
        }
        // DBに画像のパスを保存
        $result = $user->save();

        //  // 結果がfalseの場合、result_flagをfalseでreturn
        //  if(!$result){
        //     return response()->json(['result_flag' => false]);
        // }

        // // 更新後のプロフ画像を取得する
        // $prof_img = User::where('id', $my_id)->where('delete_flag', 0)->first()->picture;
        // // Log::debug($prof_img);

        // // Log::debug(response()->json(['result_flag' => true, 'picture' => $prof_img]));
        // return response()->json(['result_flag' => true, 'picture' => $prof_img]);
        return response()->json(['result_flag' => true]);

    }
}

