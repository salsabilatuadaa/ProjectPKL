<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatan = [
            [
                'id' => 1,
                'nama_jabatan' => 'kepegawaian',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'nama_jabatan' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'nama_jabatan' => 'atasan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'nama_jabatan' => 'karyawan',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
       foreach($jabatan as $jbtn){
        Jabatan::create($jbtn);
       }
    }
}
