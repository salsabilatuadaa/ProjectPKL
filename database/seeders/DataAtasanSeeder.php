<?php

namespace Database\Seeders;

use App\Models\Atasan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataAtasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataAtasan = [
            [
                'nip' => '24060121130054',
                'nama' => 'Ajeng',
                'id' => 3,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
       foreach($dataAtasan as $dataAts){
        Atasan::create($dataAts);
       }
    }
}
