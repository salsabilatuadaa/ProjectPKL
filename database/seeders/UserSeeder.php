<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'id' => 1,
                'role' => 1,
                'email' => 'kepegawaian@softui.com',
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'role' => 2,
                'email' => 'admin@softui.com',
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'role' => 3,
                'email' => 'atasan@softui.com',
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'role' => 4,
                'email' => 'karyawan@softui.com',
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
       foreach($user as $users){
        User::create($users);
       }
       
    //     DB::table('users')->insert([
    //         'id' => 1,
    //         'role' => 1,
    //         'email' => 'admin@softui.com',
    //         'password' => Hash::make('secret'),
    //         'created_at' => now(),
    //         'updated_at' => now()
    //     ],
    // );
    }
}
