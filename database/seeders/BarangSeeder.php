<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
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
                'id_kategori_barang' => '1',
                'gambar' => 'images\barang-barang\barang\1.jpg',
                'nama' => 'Pasir Kucing Cat Litter 20Kg',
                'harga_satuan' => 120000,
            ],
            [
                'id_kategori_barang' => '1',
                'gambar' => 'images\barang-barang\barang\2.jpg',
                'nama' => 'Scoop Pasir Cat Litter',
                'harga_satuan' => 10000,
            ],
            [
                'id_kategori_barang' => '2',
                'gambar' => 'images\barang-barang\barang\3.jpg',
                'nama' => 'Pakaian Anjing Ali Size M',
                'harga_satuan' => 175000,
            ],
            [
                'id_kategori_barang' => '2',
                'gambar' => 'images\barang-barang\barang\4.jpg',
                'nama' => 'Pakaian Anjing WW Size S',
                'harga_satuan' => 150000,
            ],
            [
                'id_kategori_barang' => '2',
                'gambar' => 'images\barang-barang\barang\5.jpg',
                'nama' => 'Pakaian Kucing Strip',
                'harga_satuan' => 125000,
            ],
            [
                'id_kategori_barang' => '3',
                'gambar' => 'images\barang-barang\barang\6.jpg',
                'nama' => 'Whiskas Dry Food 1.2Kg Adult',
                'harga_satuan' => 70000,
            ],
            [
                'id_kategori_barang' => '3',
                'gambar' => 'images\barang-barang\barang\7.jpg',
                'nama' => 'KC Wet Food Tuna&Salmon 400gr',
                'harga_satuan' => 20000,
            ],
            [
                'id_kategori_barang' => '3',
                'gambar' => 'images\barang-barang\barang\8.jpg',
                'nama' => 'Royal Canin Mini Puppy 2Kg',
                'harga_satuan' => 225000,
            ],
            [
                'id_kategori_barang' => '3',
                'gambar' => 'images\barang-barang\barang\9.jpg',
                'nama' => 'Royal Canin Med Adult 10Kg',
                'harga_satuan' => 740000,
            ],
            [
                'id_kategori_barang' => '3',
                'gambar' => 'images\barang-barang\barang\10.jpg',
                'nama' => 'Royal Canin Puppy Medium 4Kg',
                'harga_satuan' => 380000,
            ],
            [
                'id_kategori_barang' => '4',
                'gambar' => 'images\barang-barang\barang\11.jpg',
                'nama' => 'NutriPlus Gel',
                'harga_satuan' => 200000,
            ],
            [
                'id_kategori_barang' => '4',
                'gambar' => 'images\barang-barang\barang\12.jpg',
                'nama' => 'FuriCat',
                'harga_satuan' => 130000,
            ],
            [
                'id_kategori_barang' => '5',
                'gambar' => 'images\barang-barang\barang\13.jpg',
                'nama' => 'LactoB 1 Sachet',
                'harga_satuan' => 10000,
            ],
            [
                'id_kategori_barang' => '5',
                'gambar' => 'images\barang-barang\barang\14.jpg',
                'nama' => 'Drontal Cat Tablets',
                'harga_satuan' => 22900,
            ],
            [
                'id_kategori_barang' => '5',
                'gambar' => 'images\barang-barang\barang\15.jpg',
                'nama' => 'Fluffy Magic Tonic',
                'harga_satuan' => 225000,
            ],
            [
                'id_kategori_barang' => '5',
                'gambar' => 'images\barang-barang\barang\16.jpg',
                'nama' => 'Terramycin Salep 3.5gr',
                'harga_satuan' => 50000,
            ],
            [
                'id_kategori_barang' => '5',
                'gambar' => 'images\barang-barang\barang\17.jpg',
                'nama' => 'Cetrizine Tablets 10mg',
                'harga_satuan' => 12000,
            ],
        ];
        DB::table('barang')->insert($data);
    }
}
