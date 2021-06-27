<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ObjekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('objek')->insert([
            [
                'nama_objek' => 'Genshin Impact',
            ],
            [
                'nama_objek' => 'Mobile Legend',
            ],
            [
                'nama_objek' => 'PUBG',
            ],
        ]);
    }
}
