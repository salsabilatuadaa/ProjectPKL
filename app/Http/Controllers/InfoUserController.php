<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Atasan;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Kepegawaian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{

    public function create()
    {
        $user = Auth::user();
        $role = Jabatan::all();

        $admin = Admin::all();
        $karyawan = Karyawan::all();
        $atasan = Atasan::all();
        $kepegawaian = Kepegawaian::all();

        if ($user->role === 1) {
            return view('kepegawaian.user-profile', compact('user', 'role', 'kepegawaian'));
        }else if($user->role === 2){
            return view('admin.user-profile', compact('user', 'role', 'admin'));
        } else if ($user->role === 3) {
            return view('atasan.user-profile', compact('user', 'role', 'atasan'));
        } else if ($user->role === 4) {
            return view('karyawan.user-profile', compact('user', 'role', 'karyawan', 'atasan'));
        } 
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $user = $request->user();

        if($user -> role === 1){ //admin
            Kepegawaian::create([
                'nip' => $data['nip'],
                'nama' => $data['nama'],
                'lokasi_kerja' => $data['lokasi_kerja'],
                'user_id' => $user->id
                
            ]); 
            return redirect()->route('user-profile');
        }else if($user -> role === 2){ //admin
            Admin::create([
                'nip' => $data['nip'],
                'nama' => $data['nama'],
                'lokasi_kerja' => $data['lokasi_kerja'],
                'user_id' => $user->id
                
            ]);
            return redirect()->route('user-profile');
        }else if($user -> role === 3){ //admin
            Atasan::create([
                'nip' => $data['nip'],
                'nama' => $data['nama'],
                'lokasi_kerja' => $data['lokasi_kerja'],
                'user_id' => $user->id
                
            ]);
            return redirect()->route('user-profile');
        }else if($user -> role === 4){ //admin
            Karyawan::create([
                'nip' => $data['nip'],
                'nama' => $data['nama'],
                'lokasi_kerja' => $data['lokasi_kerja'],
                'atasan_id'=> $data['atasan_id'],
                'user_id' => $user->id
                
            ]);
            return redirect()->route('user-profile');
        }

    }

    public function update(Request $request)
    {

        $attributes = request()->validate([
            'nip' => ['required', 'max:50'],
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
            'user_id' => $attribute['user_id'],
            'lokasi_kerja' => ['max:70'],
            // 'foto profil' => ['max:150'],
        ]);


        return redirect('/user-profile')->with('success','Profile updated successfully');
    }
}
