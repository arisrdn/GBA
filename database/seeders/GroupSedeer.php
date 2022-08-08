<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Group::create([
            'id' => '1',
            'name' => 'GBA PL 2 8A',
            'group_plan_id' => '2',
        ]);
        Group::create([
            'id' => '2',
            'name' => 'GBA PL 1 ',
            'group_plan_id' => '2',
        ]);
    }
}
