<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/programs');
        }

        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records'
            ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->invalidate();

        $request->regenerateToken();

        return redirect('/');
    }
}
