<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function register_p(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25|unique:users,name|uppercase',
            'email' => 'required|unique:users,email|regex:/^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/',
            'password' => 'required|min: 8'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'slug' => Str::slug($request->name,'-'),
        ]);

        return redirect('/login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function login_p(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password')))
        {
            return redirect('settings');
        }
        return redirect('login')->with('error', 'Email or password is wrong, please try again!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
