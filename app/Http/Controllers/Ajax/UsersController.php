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

        //POST値取得
        $email = $request->input('email');
        $pass = $request->input('password');
       
        //XSS対策

        //Nullバイト攻撃対策

        //クエリ発行
        //$user = DB::select('select * from users where email = '.$email); @~.comが文法エラー
        //getはレコードの配列でくるから、配列操作必要。emailはそもそもユニークなのでfirst一択
        $user = DB::table('users')->where('email', '=', $email)->first();

        //異常判定開始
        if (empty($user)) {
            //異常検出したらさっさと返す
            return response()->json(['result_flag' => false,]);
        }

        //取ってきたパスを逆ハッシュして比較
        $pass_check = password_verify($pass, $user->password);

        if ($pass_check === false) {
            return response()->json(['result_flag' => false,]);
        }

        //異常判定終了
        //正常処理、結果的にHomeへ移動する
        return response()->json(['result_flag' => true, 'user_id' => $user->id ]);

    
        
        //レスポンス準備
        //e判定できてない
        //$result_flag = (!empty($user)) ? true : false;

        //リターン
        //return json_encode(['result_flag' => true, 'user_id' => $pass]);
        //これは通る
        //return response()->json(['result_flag' => $result_flag, ]);
       
        //return response()->json(['result_flag' => $result_flag, 'user_id' => $user->id]);
        // $user = User::where('email', $email)->get();
        // Log::debug(print_r($user));
        //$auth_flg = (!empty($user)) ? true : false;
        //$data = response()->json($user);
        //return [$auth_flg, $data];
        //$items = DB::select('select * from users where password = '.$pass.' and email = 123');
        //return $user->toJson();
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);

        $user = new User;

        // fillメソッド使用（$fillableで入力するデータを指定）
        // $result = $user->fill($request->all()->save());
        // 上のメソッド使えない（解決方法わからん、助けて）
        // 1つ1つ入力
        $user->name = $request->input('name');
        $user->location = $request->input('location');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $result_flg = $user->save();
        
        //これで登録直後のこのレコードのid取れますか？
        $user_id = $user->id;
        
        //下記のように検索いりませんか？
        //$user_id = DB::table('users')->where('email', '=', $user->email)->first()->id;

        return response()->json(['result_flg' => $result_flg, 'user_id' => $user_id]);
    }

    public function set_prof(Request $request){
        
        // GETパラメータが数字かどうかチェックする
        $id = $request->input('user_id');
        if(!ctype_digit($id)){
            return redirect('home')->with('flash_message', '不正な処理が行われました');
        }

        $user = User::find($id);

        $request->validate([
            'name' => 'nullable|max:255',
            'location' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'password' => 'nullable|max:255',
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
