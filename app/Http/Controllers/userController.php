<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class userController extends Controller
{
    //Show user registration form
    public function register() {
        return view('users.register');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
            // 'password' => 'required|confirmed|min:6' //here is another way to write using "|" (or)
        ]);

        //Hashing password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create user
        $user = User::create($formFields);

        //And then login automatically after created
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    //Logout user
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    //Show user login form
    public function login() {
        return view('users.login');
    }

    //Login user
    public function loggedin(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            //regenerate session id
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        
    }

}
