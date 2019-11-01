<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'location' => 'required|max:191',
            'email' => 'required|max:191',
            'pass' => 'required|max:191',
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->location = $request->input('location');
        $user->email = $request->input('email');
        $user->password = $request->input('pass');
        $user->save();

        return redirect('/home/home');

    }
}
