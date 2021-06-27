<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class KontenDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('konten_detail')->insert([
            [
                'id_konten' => '1',
                'jenis' => '0',
                'isi' => 'Game genshin impact melakukan update 1.6'
            ],
            [
                'id_konten' => '1',
                'jenis' => '1',
                'isi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'
            ],
            [
                'id_konten' => '1',
                'jenis' => '2',
                'isi' => 'sample_1.jpg'
            ],
            [
                'id_konten' => '2',
                'jenis' => '0',
                'isi' => 'Game genshin impact melakukan update 1.5'
            ],
            [
                'id_konten' => '2',
                'jenis' => '1',
                'isi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'
            ],
            [
                'id_konten' => '2',
                'jenis' => '2',
                'isi' => 'sample_2.jpg'
            ],
            [
                'id_konten' => '3',
                'jenis' => '0',
                'isi' => 'Game genshin impact melakukan update 1.4'
            ],
            [
                'id_konten' => '3',
                'jenis' => '1',
                'isi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'
            ],
            [
                'id_konten' => '3',
                'jenis' => '2',
                'isi' => 'sample_3.jpg'
            ],
        ]);
    }
}
