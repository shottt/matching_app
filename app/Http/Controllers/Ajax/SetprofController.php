<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SetprofController extends Controller
{
    public function update(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->occupation = $request->input('occupation');

        $user->location = $request->input('location');
        $user->email = $request->input('email');
        $result = $user->save();
    }
}
