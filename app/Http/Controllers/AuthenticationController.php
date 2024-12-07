<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function loginview()
    {
        return view('auth.login');
    }

    public function registerview()
    {
        return view('auth.register');
    }
    public function authentication(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $successLogin = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        // dd($successLogin);
        if ($successLogin) {
            $request->session()->regenerate();
            return redirect()->route('home.index')->with('success', 'Login berhasil');
        } else {
            return back()->withErrors(['login' => 'Nama Atau Password Salah']);
        }
    }
    public function registration(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login user setelah registrasi
        Auth::login($user);

        // Redirect ke halaman yang diinginkan
        return redirect()->route('home.index')->with('success', 'Registration successful. Welcome!');
    }
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
