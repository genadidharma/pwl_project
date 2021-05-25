<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'nama' => 'Genadi Dharma',
                'username' => 'genadi',
                'email' => 'genadi.alba@gmail.com',
                'password' => Hash::make('12345678'),
                'remember_token' => NULL,
                'id_level' => '1',
            ],
            [
                'nama' => 'Annisa Wahyu M',
                'username' => 'annisawm',
                'email' => 'annisawm200601@gmail.com',
                'password' => Hash::make('12345678'),
                'remember_token' => NULL,
                'id_level' => '2',
            ],
            [
                'nama' => 'Ruby Jane',
                'username' => 'jane',
                'email' => '1941720146@student.polinema.ac.id',
                'password' => Hash::make('12345678'),
                'remember_token' => NULL,
                'id_level' =>'3',
            ],
        ];
        DB::table('user')->insert($data);
    }
}
