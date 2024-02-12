<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.dashboard', compact('user'));
        } else if ($user->role === 'atasan') {
            return view('atasan.dashboard', compact('user'));
        } else if ($user->role === 'karyawan') {
            return view('karyawan.dashboard', compact('user'));
        } 
    }
}
