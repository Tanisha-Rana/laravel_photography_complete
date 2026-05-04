<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PhotographerLoginController extends Controller
{
    public function login()
    {
        if (Auth::guard('photographer')->check()) {
            return redirect('photographer/dashboard');
        }
        return view('photographer.login');
    }

    public function loginVerify(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('photographer')->attempt($credentials)) {
            $request->session()->regenerate();
            
            Alert::success('Welcome', 'Login Successful');
            return redirect()->intended('photographer/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('photographer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('photographer/login')->with('success', 'Logged out successfully');
    }
}