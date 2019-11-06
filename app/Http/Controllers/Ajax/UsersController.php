<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use Log;

class UsersController extends Controller
{
    public function sign_in(Request $request){

        $email = $request->input('email');
        $pass = $request->input('pass');
        // $user = User::where('email', $email)->get();
        $user = DB::table('users')->whereColumn([
            ['email', '=', $email],
            ['password', '=', $pass]
        ])->get();
        // Log::debug(print_r($user));
        
        //$auth_flg = (!empty($user)) ? true : false;
        // $data = response()->json($user);
        $result_flg = (!empty($user)) ? true : false;
        $user_id = $user->id;
        
        //return [$auth_flg, $data];
        return response()->json(['result_flg' => $result_flg, 'user_id' => $user_id]);
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'email' => 'required|max:255',
            'pass' => 'required|max:255',
        ]);

        $user = new User;

        // fillメソッド使用（$fillableで入力するデータを指定）
        // $result = $user->fill($request->all()->save());
        // 上のメソッド使えない（解決方法わからん、助けて）
        // 1つ1つ入力
        $user->name = $request->input('name');
        $user->location = $request->input('location');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('pass'));
        $result_flg = $user->save();
        $user_id = $user->id;

        return response()->json(['result_flg' => $result_flg, 'user_id' => $user_id]);
    }

    public function set_prof(Request $request, $id){
        // GETパラメータが数字かどうかチェックする
        if(!ctype_digit($id)){
            return redirect('home')->with('flash_message', '不正な処理が行われました');
        }

        $user = User::find($id);

        $request->validate([
            'name' => 'nullable|max:255',
            'location' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'pass' => 'nullable|max:255',
        ]);

        // fillメソッド使用
        // $user->fill($request->all()->save());

        $user->name = $request->input('name');
        $user->occupation = $request->input('occupation');

        $user->location = $request->input('location');
        $user->email = $request->input('email');
        $result = $user->save();
    }

    // public function change_pass(Request $request, $id){
    //     $user = User::find($id);

    //     $pass_now = $request->input('pass_now');
    //     $pass_new = $request->input('pass_new');
        
    //     $user_id = $user->id;
    //     $result_flg = $user->where()
    // }
}
