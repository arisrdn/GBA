<?php

namespace Database\Seeders;

use App\Models\ChurchBranch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChurchBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ChurchBranch::create([
            'address'=>'jl abc',
            'name' => 'ALam Sutera',
            'church_id'=>1
        ]);
        ChurchBranch::create([
            'address'=>'jl abc',
            'name' => 'Jaksel',
            'church_id'=>1
        ]);
        ChurchBranch::create([
            'address'=>'jl abc',
            'name' => 'jakpus',
            'church_id'=>1
        ]);
        ChurchBranch::create([
            'address'=>'jl abc',
            'name' => 'palembang',
            'church_id'=>1
        ]);
    }
}
