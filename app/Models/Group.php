<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'group_plan_id',

    ];

    public function member()
    {
        return $this->hasMany(GroupMember::class);
    }
    public function ativity()
    {
        return $this->hasMany(GroupActivity::class);
    }
}
