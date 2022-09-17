<?php

namespace Database\Seeders;

use App\Models\ReasonLeave;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ReasonLeave::create([
            "id" => 2,
            'reason' => 'salah pilih rencana baca',
        ]);
        ReasonLeave::create([
            "id" => 1,
            'reason' => 'Rencana baca terlalau panjang',
        ]);
    }
}
