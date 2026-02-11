<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Proses login (username + password)
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        

      if (! Auth::attempt($request->only('username','password'))) {
    throw ValidationException::withMessages([
        'username' => 'Username atau password salah',
    ]);
        }

        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    /**
     * Proses logout
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
