<?php

namespace Database\Seeders;

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

        $data = GroupTodolist::where("group_id", 1)->get();
        // dd($data);
        foreach ($data as  $val) {
            // echo $value->day;
            MemberTodolist::create([
                'group_member_id' => 3,
                'group_todolist_id' => $val->id,
                'read_at' => Carbon::yesterday(),
                'schedule' => Carbon::tomorrow()->addDays($val->day)
            ]);
            MemberTodolist::create([
                'group_member_id' => 6,
                'group_todolist_id' => $val->id,
                'schedule' => Carbon::tomorrow()->addDays($val->day)
            ]);
        }
    }
}
