<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Log;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function friend_search(){
        
        // 自分のユーザーIDを取得
        $auth_id = Auth::id();
        Log::debug($auth_id);
        // 必要なカラムだけ取ってくる、自分のユーザーID以外かつdelete_flagが0のユーザー取って来る
        // セキュリティ対策も必要（ヌルバイト、SQLインジェクション、ディレクトリトラバーサルは？）
        // $user = User::whereNotIn('id', $auth_id)->get(); → この書き方だとエラー
        $user = User::where('id', '!=', $auth_id)->where('delete_flag', 0)->get(['id', 'name', 'occupation']);

        Log::debug(print_r($user, true));

        // 異常判定
        if(empty($user)){
            // ユーザーデータが空の場合はfalseを返す
            return response()->json(['result_flag' => false]);
        }
        // $id = $user->id;
        // // $picture = $user->picture;
        // $name = $user->name;
        // $occupation = $user->occupation;

        return response()->json(['result_flag' => true, 'id' => $user->id, 'name' => $user->name, 'occupation' => $user->occupation]);

    }


    public function index(){
        return view('picture');
    }

    public function store(UserRequest $request){

    }
}
