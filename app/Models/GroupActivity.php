<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupActivity extends Model
{
    use HasFactory;

    protected $fillable = [

        'reading_group_id',
        'chapter_verse',
        'day'
    ];
}
