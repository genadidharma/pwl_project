<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama' => 'peralatan',
            ],
            [
                'nama' => 'pakaian',
            ],
            [
                'nama' => 'makanan',
            ],
            [
                'nama' => 'vitamin',
            ],
            [
                'nama' => 'obat',
            ],
        ];
        DB::table('kategori_barang')->insert($data);
    }
}
