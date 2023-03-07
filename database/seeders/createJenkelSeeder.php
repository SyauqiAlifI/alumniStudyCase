<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class createJenkelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create a dummy data
        \App\Models\jenis_kelamin::create(
            [
                'jenkel' => 'laki-laki'
            ],
            [
                'jenkel' => 'perempuan'
            ]
        );
    }
}
