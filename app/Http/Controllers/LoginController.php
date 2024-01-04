<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function redirectTo()
    {
        return view('login.index');
    }


    public function check()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // attempt : is take care of signing you in and check if the email and password is matching
        if (!auth()->attempt($attributes)) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'The Email or Password Could not be correct']);
        }

        session()->regenerate(); // For session fixation
        return redirect('/')->with('success', 'Welcome Back!');
    }


    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'GoodBye!');
    }
}
