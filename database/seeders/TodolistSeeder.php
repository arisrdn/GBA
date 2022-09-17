<?php

namespace Database\Seeders;

use App\Models\groupAdmin;
use App\Models\GroupTodolist;
use App\Models\MemberTodolist;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodolistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        groupAdmin::create([
            'user_id' => '3',
            'group_id' => '1',
            'type' => '0',
        ]);
        groupAdmin::create([
            'user_id' => '3',
            'group_id' => '2',
            'type' => '1',
        ]);
        groupAdmin::create([
            'user_id' => '3',
            'group_id' => '3',
            'type' => '1',

        ]);
        groupAdmin::create([
            'user_id' => '4',
            'group_id' => '1',
            'type' => '1',

        ]);
        groupAdmin::create([
            'user_id' => '4',
            'group_id' => '2',
            'type' => '0',

        ]);
        groupAdmin::create([
            'user_id' => '4',
            'group_id' => '3',
            'type' => '0',

        ]);
        groupAdmin::create([
            'user_id' => '5',
            'group_id' => '1',
            'type' => '0',

        ]);
        groupAdmin::create([
            'user_id' => '5',
            'group_id' => '2',
            'type' => '0',

        ]);
    }
}
