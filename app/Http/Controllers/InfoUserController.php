<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('user-profile');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            // 'nip' => ['required', 'max:50'],
            'name' => ['required', 'max:50'],
            // 'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'lokasi_kerja' => ['max:70'],
            // 'foto profil' => ['max:150'],
            'user_id' => ['required', 'id','max:50', Rule::unique('users')->ignore(Auth::user()->id)]
        ]);
        if($request->get('user_id') != Auth::user()->id)
        {
            if(env('IS_DEMO') && Auth::user()->id == 1)
            {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
                
            }
            
        }
        else{
            $attribute = request()->validate([
                'user_id' => ['required', 'id','max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }
        
        
        Karyawan::where('user_id',Auth::user()->id)
        ->update([
            'name'    => $attributes['name'],
            //'email' => $attribute['email'],
            'user_id' => $attribute['user_id'],
            'lokasi_kerja' => ['max:70'],
            // 'foto profil' => ['max:150'],
        ]);


        return redirect('/user-profile')->with('success','Profile updated successfully');
    }
}
