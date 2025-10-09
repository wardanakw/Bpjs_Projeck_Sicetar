<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
      
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'captcha'  => 'required|captcha',
        ], [
            'captcha.captcha' => 'Captcha tidak valid, silakan coba lagi.',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

  
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
