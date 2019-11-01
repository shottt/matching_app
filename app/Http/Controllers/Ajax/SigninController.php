<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class SigninController extends Controller
{
    public function show(Request $request){
        
        $email = $request->input('email');
        $pass = $request->input('pass');
        $user = User::where('email', $email)->where('password', $pass)->get();

        $data = response()->json($user[0]);
        return $data;
        
    }
}
