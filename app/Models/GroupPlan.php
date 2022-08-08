<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
    ];
    protected $hidden = ['updated_at'];
    // protected $hidden = [''];
}
