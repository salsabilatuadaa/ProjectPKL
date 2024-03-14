<?php

namespace Database\Seeders;

use App\Models\JenisCuti;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_cuti = [
            [
                'id' => 1,
                'nama_cuti' => 'Cuti Sakit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'nama_cuti' => 'Cuti Besar',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'nama_cuti' => 'Cuti Tahunan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'nama_cuti' => 'Cuti Melahirkan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'nama_cuti' => 'Cuti Alasan Penting',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
       foreach($jenis_cuti as $jeniscuti){
        JenisCuti::create($jeniscuti);
       }
    }
}

