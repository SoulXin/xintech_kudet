<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class KontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('konten')->insert([
            [
                'nama_konten' => 'Update Genshin Impach 1.6',
                'banner_konten' => 'sample_1.jpg',
                'status' => '1',
                'jenis_konten' => 'game_event',
                'id_objek' => '3'
            ],
            [
                'nama_konten' => 'Update Genshin Impach 1.5',
                'banner_konten' => 'sample_2.jpg',
                'status' => '1',
                'jenis_konten' => 'hardware',
                'id_objek' => '2'
            ],
            [
                'nama_konten' => 'Update Genshin Impach 1.4',
                'banner_konten' => 'sample_3.jpg',
                'status' => '1',
                'jenis_konten' => 'entertaiment',
                'id_objek' => '1'
            ],
        ]);
    }
}
