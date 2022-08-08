<?php

namespace Database\Seeders;

use App\Models\GroupPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupPlanSeder extends Seeder
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
            'description' => '1 ayat perhari',
        ]);
        GroupPlan::create([
            'id' => '2',
            'description' => '2 ayat perhari',
        ]);
        GroupPlan::create([
            'id' => '3',
            'description' => '3 ayat perhari',
        ]);
    }
}
