<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'agreement' => ['accepted']
        ], [
            'role.required' => 'Role is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'agreement.accepted' => 'You must accept the terms and conditions',
        ]);
        // $attributes['password'] = bcrypt($attributes['password'] );

        $user = User::create([
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        // session()->flash('success', 'Your account has been created.');
        // $user = User::create($attributes);
        Auth::login($user); 
        return redirect('/dashboard');
    }
}
