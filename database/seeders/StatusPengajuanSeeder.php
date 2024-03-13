<?php

namespace Database\Seeders;

use App\Models\StatusPengajuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            [
                'id' => 1,
                'status' => 'disetujui',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'status' => 'tidak disetujui',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'status' => 'menunggu verifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
       foreach($status as $stats){
        StatusPengajuan::create($stats);
       }
    }
}
