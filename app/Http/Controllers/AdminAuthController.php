<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    // Menampilkan form login di /admin
    public function showLoginForm()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.matches.index');
        }
        return view('admin.login');
    }

    // Proses pengecekan login
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Kredensial sesuai permintaan Anda
        if ($username === 'admin' && $password === 'password') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.matches.index');
        }

        return redirect()->back()->with('error', 'Username atau Password salah!');
    }

    // Proses logout
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}