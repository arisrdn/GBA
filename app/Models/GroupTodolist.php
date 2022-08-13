<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTodolist extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'chapter_verse',
        'day'
    ];
    protected $hidden = ['created_at', 'updated_at', 'id'];
}
