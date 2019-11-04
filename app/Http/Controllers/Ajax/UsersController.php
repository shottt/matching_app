<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function show(Request $request){
        
        $email = $request->input('email');
        $pass = $request->input('pass');
        $user = User::where('email', $email)->where('password', $pass)->get()->toArray();
        
        $auth_flg = (!empty($user)) ? true : false;
        $data = response()->json($user);
        
        return [$auth_flg, $data];
        
    }

    public function store(Request $request)
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

        // 1つ1つ入力
        $user->name = $request->input('name');
        $user->location = $request->input('location');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('pass'));
        $result = $user->save();

        $data = response()->json($result);
        return $data;
    }

    public function update(Request $request, $id){
        $user = User::find($id);

        $request->validate([
            'name' => 'nullable|max:255',
            'location' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'pass' => 'nullable|max:255',
        ]);

        $user->name = $request->input('name');
        $user->occupation = $request->input('occupation');

        $user->location = $request->input('location');
        $user->email = $request->input('email');
        $result = $user->save();
    }
}
