<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Chat;
use App\Comment;
use Log;

class ChatsController extends Controller
{
    // チャットコメントを取得
    public function get_chat(Request $request){
        // 自分のユーザーIDを取得
        $auth_id = Auth::id();
        Log::debug('自分のユーザーID：' .$auth_id);

        // 相手のユーザーIDを取得
        $user_id = $request->user_id;
        // $user_id = 2;
        Log::debug('相手のユーザーID：' .$user_id);

        // 異常判定
        if(empty($user_id)){
            return response()->json(['result_flag' => false]);
        }

        // 自分のユーザーIDと相手のユーザーIDにマッチするチャット情報を取得する
        $chat_id = DB::table('chats')->where('from_user', $auth_id)->where('to_user', $user_id)->first(['id'])->id;
        Log::debug('チャットID：' .print_r($chat_id, true));

        // 異常判定
        if(empty($chat_id)){
            return response()->json(['result_flag' => false]);
        }

        // コメントを降順で10件取得する
        $comments = DB::table('comments')->where('chat_id', $chat_id)->orderBy('created_at', 'desc')->take(10)->get();
        Log::debug('コメント情報一覧：' .print_r($comments, true));

        // 異常判定
        if(empty($comments)){
            return response()->json(['result_flag' => false]);
        }

        Log::debug(response()->json(['result_flag' => true, 'commnets' => $comments]));
        return response()->json(['result_flag' => true, 'comments' => $comments]);

    }

    public function add_chat_comment(){
        // バリデーション

        // モデル作成
        
    }
}
