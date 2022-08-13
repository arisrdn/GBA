<?php

namespace Database\Seeders;

use App\Imports\GroupTodolistImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class GroupActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Excel::import(new GroupTodolistImport(1), public_path('/files/upload.xlsx'));
    }
}
