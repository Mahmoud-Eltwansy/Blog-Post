<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(){
        $attributes=request()->validate([
           'name'=>['required','max:255'],
            'username'=>['required','max:255','min:3',Rule::unique('users','username')],
            'email'=>['required','max:255','email',Rule::unique('users','email')],
            'password'=>['required','max:255','min:8']
        ]);
        $user=User::create($attributes);
        auth()->login($user);

//      session()->flash('success','Your account has been created successfully.');
        return redirect('/')->with('success','Your account has been created successfully.'); // with :Flash a piece of data to the session.
    }
}
