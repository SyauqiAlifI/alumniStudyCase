<?php

namespace Database\Seeders;
require_once('vendor/autoload.php');

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class createSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            // insert data ke table siswas
            DB::table('siswas')->insert([
                'nama' => $faker->name,
                'id_jenkel' => $faker->numberBetween(1, 2),
                // 'nik' => $faker->numberBetween(1000000000, 9999999999),
                'nik' => $faker->regexify('^0068[0-9]{6}$'),
                'tgl_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'jurusan' => $faker->randomElement(['RPL', 'TKJ', 'DMM']),
                'angkatan' => $faker->numberBetween(1, 6),
                'alamat' => $faker->address
            ]);
        }
    }
}
