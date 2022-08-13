<?php

namespace App\Imports;

use App\Models\GroupTodolist;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

// class GroupActivityImport implements ToModel
class GroupTodolistImport implements ToModel, WithHeadingRow

{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function  __construct($group_id)
    {
        $this->group_id = $group_id;
    }
    public function model(array $row)
    {
        // dd($row);
        return new GroupTodolist([
            //
            'group_id' => $this->group_id,
            'day' => $row['day'],
            'chapter_verse' => $row['chapterverse'],
        ]);
    }
}
