<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view("login.index");
    }
    public function verify(Request $request)
{
    session(['username' => $request->username]);

    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ], [
        'username.required' => 'Please enter a valid Username',
        'password.required' => 'Please enter a valid Password',
    ]);

    $loginInfo = [
        'username' => $request->username,
        'password' => $request->password
    ];

    if (Auth::attempt($loginInfo)) {
        $user = Auth::user();
        session(['username' => $user->username]);
        session(['role' => $user->role]);

        if ($user->role === 'kasir') {
            return redirect()->route('kasir.index'); // Redirect to kasir dashboard
        } else {
            return redirect()->route('dashboard.index'); // Redirect to admin or other dashboard
        }
    } else {
        return redirect('/')->with('error', 'Invalid username or password.');
    }
}

    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

