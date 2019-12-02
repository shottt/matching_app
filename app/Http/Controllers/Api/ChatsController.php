<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function get_chat(){
        // 自分のユーザーIDを取得
        $auth_id = Auth::id();

        

    }

    public function add_chat_comment(){

    }
}
