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
    //chatを新規作成
    //get_chat でchat_idが見つからない時に使う　リダイレクトで使う
    public function create_chat(Request $request){
        // 自分のユーザーIDを取得
        log::debug("create_chat : start");
        $my_id = $request->header('aut_id');
        Log::debug('1 自分のユーザーID：' .$my_id);
        // 受け取った自分のユーザーIDがログインユーザーのIDか判定（同時にmy_idを受け取れているか確認）
        if($my_id != Auth::id()){
            return response()->json(['result_flag' => false]);
        }
        // 相手のユーザーIDを取得
        $user_id = $request->user_id;
        Log::debug('2 相手のユーザーID：' .$user_id);

        // 異常判定
        if(empty($user_id)){
            return response()->json(['result_flag' => false]);
        }

        // モデル作成
        $chat = new Chat;
        $chat->to_user = $user_id;
        $chat->from_user = $my_id;
        $chat->save();

        // 作成したレコードのチャットIDを取ってくる
        $chat_id = $chat->id;
        Log::debug('3 チャットID：' .print_r($chat_id, true));

        // 異常判定
        if(empty($chat_id)){
            return response()->json(['result_flag' => false]);
        }

        // コメントを降順で10件取得する
        $comments = Comment::where('chat_id', $chat_id)->orderBy('created_at', 'desc')->take(10)->get();
        Log::debug('4 コメント情報一覧：' .print_r($comments, true));

        Log::debug(response()->json(['result_flag' => true, 'comments' => $comments]));
        return response()->json(['result_flag' => true, 'comments' => $comments]);

    }

    // チャットコメントを取得
    public function get_chat(Request $request){
        // 自分のユーザーIDを取得
        $my_id = $request->header('aut_id');
        Log::debug('1 自分のユーザーID：' .$my_id);

        // 変数の型をログに出力
        // Log::debug('自分のユーザーID：' . gettype($my_id));
        // Log::debug('ログインID：' . gettype(Auth::id()));

        // 受け取った自分のユーザーIDがログインユーザーのIDか判定（同時にmy_idを受け取れているか確認）
        if($my_id != Auth::id()){
            return response()->json(['result_flag' => false]);
        }

        // 相手のユーザーIDを取得
        $user_id = $request->user_id;
        Log::debug('2 相手のユーザーID：' .$user_id);

        // 異常判定
        if(empty($user_id)){
            return response()->json(['result_flag' => false]);
        }

        // 自分のユーザーIDと相手のユーザーIDにマッチするチャット情報を取得する
        $chat = DB::table('chats')->where('from_user', $my_id)->where('to_user', $user_id)->first(['id']);
        if (empty($chat)) {
            $chat = DB::table('chats')->where('from_user', $user_id)->where('to_user', $my_id)->first(['id']);
        }

        // チャット情報が見つからない場合にcreate_chatアクションを呼び出す
        if(empty($chat)){
            return redirect()->action('Api\ChatsController@create_chat', ['my_id' => $my_id, 'user_id' => $user_id]);
        }

        // チャットIDを取得する
        $chat_id = $chat->id;
        Log::debug('3 チャットID：' .print_r($chat->id, true));
        // コメントを降順で10件取得する
        $comments = DB::table('comments')->where('chat_id', $chat_id)->orderBy('created_at', 'desc')->take(10)->get();
        Log::debug('4 コメント情報一覧：' .print_r($comments, true));

        // 異常判定
        if(empty($comments)){
            return response()->json(['result_flag' => false]);
        }

        // Log::debug(response()->json(['result_flag' => true, 'commnets' => $comments]));
        return response()->json(['result_flag' => true, 'comments' => $comments]);

    }

    // 最新チャットコメント1件を取得
    public function get_new_chat(Request $request){
        $chat_id = $request->chat_id;
        
        $comment = DB::table('comments')->where('chat_id', $chat_id)->orderBy('created_at', 'desc')->first();
        Log::debug('4 コメント情報一覧：' .print_r($comment, true));

        /*
        // 異常判定
        if(empty($comment)){
            return response()->json(['result_flag' => false]);
        }
*/
        Log::debug(response()->json(['result_flag' => true, 'commnet' => $comment]));
        return response()->json(['result_flag' => true, 'comment' => $comment]);

    }
    

    // チャットコメント追加
    public function add_chat_comment(Request $request){
        // バリデーション
        // $this->validate($request, Comment::$rules);
        // Log::debug($request);

        $my_id = $request->header('aut_id');
        $user_id = $request->user_id;
        // $chat_id = $request->chat_id;
       
        // 受け取った自分のユーザーIDがログインユーザーのIDか判定
        if($my_id != Auth::id()){
            return response()->json(['result_flag' => false]);
        }

        // チャットIDを取得する
        // 自分のユーザーIDと相手のユーザーIDにマッチするチャット情報を取得する
        $chat_id = DB::table('chats')->where('from_user', $my_id)->where('to_user', $user_id)->first(['id'])->id;

        if (empty($chat_id)) {
            $chat_id = DB::table('chats')->where('from_user', $user_id)->where('to_user', $my_id)->first(['id'])->id;
        }
        Log::debug($chat_id);

        // モデル作成
        $comment = new Comment;
        // 値を一つ一つ保存（一括保存方法にfillメソッドがあるが、今回は使用しない）
        $comment->chat_id = $chat_id;
        $comment->to_user = $user_id;
        $comment->from_user = $my_id;
        $comment->detail = $request->comment;
        $comment->save();

        return response()->json(['result_flag' => true]);
    }
}
