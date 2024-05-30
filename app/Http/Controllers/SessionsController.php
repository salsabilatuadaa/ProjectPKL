<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        // Tentukan apakah login_id adalah email atau NIP
        $credentials = filter_var($attributes['login'], FILTER_VALIDATE_EMAIL) 
                        ? ['email' => $attributes['login'], 'password' => $attributes['password']]
                        : ['nip' => $attributes['login'], 'password' => $attributes['password']];

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            $user = Auth::user();

            if ($user->profileKarIsComplete() || $user->profileAtsIsComplete() || $user->profileAdmIsComplete() || $user->profileKepIsComplete()) {
                return redirect('dashboard');
            } else {
                return redirect()->route('user-profile')->with('warning', 'Please complete your profile.');
            }
        } else {
            return back()->withErrors(['login' => 'Email, NIP, or password is invalid.']);
        }
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
}
