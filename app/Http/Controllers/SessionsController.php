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
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            if (Auth::user()->profileKarIsComplete() || Auth::user()->profileAtsIsComplete() || Auth::user()->profileAdmIsComplete() || Auth::user()->profileKepIsComplete()) {
                return redirect('dashboard');
            } else {
                return redirect()->route('user-profile')->with('warning', 'Please complete your profile.');
            }
        }
        else{

            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
