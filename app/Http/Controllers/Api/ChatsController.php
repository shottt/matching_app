<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Log;

class ChatsController extends Controller
{
    // チャットコメントを取得
    public function get_chat(Request $request){
        // 自分のユーザーIDを取得
        $auth_id = Auth::id();
        Log::debug($auth_id);

        // 相手のユーザーIDを取得
        // $user_id = $request->user_id;
        $user_id = 2;
        Log::debug($user_id);
        
        // 異常判定
        if(empty($user_id)){
            return response()->json(['result_flag' => false]);
        }

        $chat_id = DB::table('chats')->where('from_user', $auth_id)->where('to_user', $user_id)->first('id');
        Log::debug(print_r($chat_id, true));
        $comments = DB::table('messages')->where('chat_id', $chat_id)->get();
        Log::debug(print_r($comments, true));

        return response()->json(['result_flag' => true, 'comments' => $comments]);

    }

    public function add_chat_comment(){

    }
}
