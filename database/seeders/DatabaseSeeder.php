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
        $this->call(ObjekSeeder::class);
        $this->call(KontenSeeder::class);
        $this->call(KontenDetailSeeder::class);
        $this->call(UserSeeder::class);
    }
}
