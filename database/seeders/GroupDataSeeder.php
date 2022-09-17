<?php

namespace Database\Seeders;

use App\Imports\GroupTodolistImport;
use App\Models\Group;
use App\Models\GroupEod;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class GroupDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'id' => '1',
            'name' => 'GBA PL 1 8A',
            'group_plan_id' => '1',
            'start_date' => Carbon::yesterday()->subMonth(3),
            'end_date' => Carbon::now()->subDay(7),
        ]);
        Group::create([
            'id' => '2',
            'name' => 'GBA PL 1 8B',
            'group_plan_id' => '2',
            'start_date' => Carbon::yesterday()->subMonth(2),
            'end_date' => Carbon::now()
        ]);
        Group::create([
            'id' => '3',
            'group_plan_id' => '1',
            'name' => 'GBA PL 1 8d',
            'start_date' => Carbon::yesterday()->subMonth(2),
            'end_date' => Carbon::now()->addDay(4)
        ]);
        Group::create([
            'id' => '4',
            'group_plan_id' => '2',
            'name' => 'GBA PL 2A ',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::yesterday()->addMonth(2)
        ]);
        Excel::import(new GroupTodolistImport(1), public_path('/files/upload.xlsx'));
        Excel::import(new GroupTodolistImport(2), public_path('/files/upload.xlsx'));
        Excel::import(new GroupTodolistImport(3), public_path('/files/upload.xlsx'));
        Excel::import(new GroupTodolistImport(4), public_path('/files/upload.xlsx'));

        GroupEod::create([

            'group_id' => '1',
        ]);
        GroupEod::create([

            'group_id' => '2',
        ]);
        GroupEod::create([

            'group_id' => '3',
        ]);
    }
}
