<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitingList extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "data",
        "type",
        "group_plan_id",
        "reason_leave_id",
    ];

    public function plan()
    {
        return $this->belongsTo(GroupPlan::class, "group_plan_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function reason()
    {
        return $this->belongsTo(ReasonLeave::class, "reason_leave_id");
    }
}
