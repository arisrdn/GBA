<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_id',
        'group_id',
        'message'

    ];
    protected $hidden = [
        'updated_at'
    ];
}
