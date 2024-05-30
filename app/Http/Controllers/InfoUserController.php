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
                'nama' => $data['nama'],
                'lokasi_kerja' => $data['lokasi_kerja'],
                'user_id' => $user->id
                
            ]);
            $user->update([
                'email' => $data['email']
            ]);
            return redirect()->route('user-profile');
        }else if($user -> role === 2){ //admin
            Admin::create([
                'nama' => $data['nama'],
                'lokasi_kerja' => $data['lokasi_kerja'],
                'user_id' => $user->id
                
            ]);
            $user->update([
                'email' => $data['email']
            ]);
            return redirect()->route('user-profile');
        }else if($user -> role === 3){ //admin
            Atasan::create([
                'nama' => $data['nama'],
                'lokasi_kerja' => $data['lokasi_kerja'],
                'user_id' => $user->id
                
            ]);
            $user->update([
                'email' => $data['email']
            ]);
            return redirect()->route('user-profile');
        }else if($user -> role === 4){ //admin
            Karyawan::create([
                'nama' => $data['nama'],
                'lokasi_kerja' => $data['lokasi_kerja'],
                'atasan_id'=> $data['atasan_id'],
                'user_id' => $user->id
                
            ]);
            $user->update([
                'email' => $data['email']
            ]);
            return redirect()->route('user-profile');
        }

    }
    

    public function editDataUser()
    {
        $user = Auth::user();
        $role = Jabatan::all();

        $admin = Admin::all();
        $karyawan = Karyawan::all();
        $atasan = Atasan::all();
        $kepegawaian = Kepegawaian::all();

        if ($user->role === 1) {
            return view('kepegawaian.edit-profile', compact('user', 'role', 'kepegawaian'));
        }else if($user->role === 2){
            return view('admin.edit-profile', compact('user', 'role', 'admin'));
        } else if ($user->role === 3) {
            return view('atasan.edit-profile', compact('user', 'role', 'atasan'));
        } else if ($user->role === 4) {
            return view('karyawan.edit-profile', compact('user', 'role', 'karyawan', 'atasan'));
        } 
    }

    public function updateDataUser(Request $request, $id)
    {
        $user = Auth::user();

        switch ($user->role) {
            case 1:
                $model = Kepegawaian::find($id); 
                break;
            case 2:
                $model = Admin::find($id);
                break;
            case 3:
                $model = Atasan::find($id);
                break;
            case 4:
                $model = Karyawan::find($id);
                break;
            default:
                return redirect()->back()->with('error', 'Peran pengguna tidak valid.');
        }

        if (!$model) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    
        $model->update($request->only(['nama', 'lokasi_kerja']));
    
        if ($user->role == 1 && $request->has('email')) {
            $user->update(['email' => $request->input('email')]);
        } else if ($user->role == 2 && $request->has('email')) {
            $user->update(['email' => $request->input('email')]);
        } else if ($user->role == 3 && $request->has('email')) {
            $user->update(['email' => $request->input('email')]);
        } else if ($user->role == 4 && $request->has('email')) {
            $user->update(['email' => $request->input('email')]);
        } 
    


        return redirect()->route('user-profile')->with('success', 'Data berhasil diperbarui.');
    }

    // public function updateDataUser(Request $request, $id){

    //     $user = Auth::user();
    //     $role = Jabatan::all();

    //     $admin = Admin::find($id);
    //     $karyawan = Karyawan::find($id);
    //     $atasan = Atasan::find($id);
    //     $kepegawaian = Kepegawaian::find($id);

    //     $admin->update($request->all());
    //     $karyawan->update($request->all());
    //     $atasan->update($request->all());
    //     $kepegawaian->update($request->all());

    //     return redirect()->route('user-profile')->with('success', 'Data Berhasil di Update');

    // }



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
