<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            JabatanSeeder::class,
            StatusPengajuanSeeder::class,
            JenisCutiSeeder::class,
            UserSeeder::class,
            // DataAtasanSeeder::class,
            // DataKaryawanSeeder::class,
        ]);
    }
}
