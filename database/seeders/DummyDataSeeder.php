<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ChurchSeeder::class,
            ChurchBranchSeeder::class,

            GroupDataSeeder::class,
            UserDataSeeder::class,

            // TodolistSeeder::class,
            // MemeberSeeder::class,

            ChatSeeder::class,


        ]);
    }
}
