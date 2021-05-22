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
                'email' => 'genadidharma@gmail.com',
                'password' => '12345',
                'remember_token' => '12345',
                'id_level' => '1',
            ],
            [
                'nama' => 'Annisa Wahyu M',
                'username' => 'annisawm',
                'email' => 'annisawm@gmail.com',
                'password' => '12345',
                'remember_token' => '12345',
                'id_level' => '2',
            ],
            [
                'nama' => 'Ruby Jane',
                'username' => 'jane',
                'email' => 'r.jane@gmail.com',
                'password' => '12345',
                'remember_token' => '12345',
                'id_level' =>'3',
            ],
        ];
        DB::table('user')->insert($data);
    }
}
