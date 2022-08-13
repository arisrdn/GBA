<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberTodolist extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_member_id',
        'group_todolist_id',
        'read_at',
        'schedule',
    ];
    protected $hidden = ['created_at', 'updated_at'];


    public function todolist()
    {
        return $this->belongsTo(GroupTodolist::class, "group_todolist_id", 'id');
    }
}
