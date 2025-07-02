<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form registrasi
    public function registerForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // default role
        ]);

        Auth::login($user); // langsung login setelah registrasi
        return redirect('/user/dashboard');
    }

    // Tampilkan form login
    public function loginForm()
    {
        return view('auth.login');
    }

    // Proses login: validasi nama, email, dan password
    public function login(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)
            ->where('name', $request->name)
            ->first();

        if ($user && is_string($user->password) && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            return $user->role === 'admin'
                ? redirect('/admin/dashboard')
                : redirect('/user/dashboard');
        }

        return back()->withErrors([
            'email' => 'Nama, email, atau password salah.',
        ]);
    }


    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        session()->flush(); // hapus semua data session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
