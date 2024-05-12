<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function proses_login(Request $request)
    {
        $input = $request->only('email', 'password');

        if (auth('')->attempt($input)) {
            if (auth('')->user()->role == 'Admin') {
                return redirect('/admin');
            } else {
                return redirect('/petugas');
            }
        };
        return redirect('/')->with('error', 'Email dan password anda salah!');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda berhasil logout!');
    }
}
