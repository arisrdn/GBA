<?php

namespace Database\Seeders;

use App\Models\Church;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChurchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Church::create([
            'id' => '1',
            'name' => 'Gereja Bethany Indonesia - Bethany',
        ]);
        Church::create([
            'id' => '2',
            'name' => 'Gereja Bethel Indonesia - GBI',
        ]);
        Church::create([
            'id' => '3',
            'name' => 'Gereja Bethel - GBI2',
        ]);
        Church::create([
            'id' => '4',
            'name' => 'Gereja Bethel - GBI3',
        ]);
    }
}
