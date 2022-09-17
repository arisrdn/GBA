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
        "todo_file",
        "start_date",
        "end_date"


    ];

    public function member()
    {
        return $this->hasMany(GroupMember::class);
    }

    public function totalMember()
    {
        return $this->hasMany(GroupMember::class)->count();
    }
    public function admin()
    {
        return $this->hasMany(GroupAdmin::class);
    }
    public function todo()
    {
        return $this->hasMany(GroupTodolist::class);
    }
    public function plan()
    {
        return $this->belongsTo(GroupPlan::class, 'group_plan_id');
    }
    // public function eod()
    // {
    //     return $this->hasOne(GroupEod::class);
    // }
    public function ativity()
    {
        return $this->hasMany(GroupActivity::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class, GroupMember::class);
    }
    public function lastChat()
    {
        return $this->hasMany(GroupChat::class, 'group_id', 'id')->first();
    }
    // public function status()
    // {

    //     if ($this::where("end_date", "<" . today())) {
    //         # code...
    //         return "true";
    //     } else {
    //         # code...
    //         return "false";
    //     }
    // }
}
