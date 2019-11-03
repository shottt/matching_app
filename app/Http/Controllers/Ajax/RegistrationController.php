<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'email' => 'required|max:255',
            'pass' => 'required|max:255',
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->location = $request->input('location');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('pass'));
        $result = $user->save();

        $data = response()->json($result);
        return $data;

    }
}
