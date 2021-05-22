<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LevelSeeder extends Seeder
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
                'nama' => 'admin',
            ],
            [
                'nama' => 'kasir',
            ],
            [
                'nama' => 'dokter',
            ],
        ];
        DB::table('level')->insert($data);
    }
}
