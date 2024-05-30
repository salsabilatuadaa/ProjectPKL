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
                'nip' => '196609151994031007',
                'password' => Hash::make('1234'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'role' => 2,
                'nip' => '196504251988031008',
                'password' => Hash::make('1234'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'role' => 3,
                'nip' => '198705082010011011',
                'password' => Hash::make('1234'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'role' => 4,
                'nip' => '197411271994031004',
                'password' => Hash::make('1234'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
       foreach($user as $users){
        User::create($users);
       }
       
    }
}
