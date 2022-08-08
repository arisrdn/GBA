<?php

namespace Database\Seeders;

use App\Models\GroupPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        GroupPlan::create([
            'id' => '1',
            'name' => 'Gereja Bethany Indonesia - Bethany',
        ]);
        GroupPlan::create([
            'id' => '2',
            'name' => 'Gereja Bethel Indonesia - GBI',
        ]);
    }
}
