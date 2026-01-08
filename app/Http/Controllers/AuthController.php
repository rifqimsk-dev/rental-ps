<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan ROLE
            $role = Auth::user()->role;

            if ($role === 'admin' || $role === 'user') {
                return redirect('/');
            }

            // default jika role tidak dikenali
            return redirect('/login')->with('alert', 'Hak akses tidak ditemukan');
        }

        // jika gagal login
        return back()->withErrors([
            'failed' => 'Email atau password salah'
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
