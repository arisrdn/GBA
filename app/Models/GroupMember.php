<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'group_id',
        'approved_at',
        'leave_at',
        'complete_at',
        'leave_at',
    ];
    public function group()
    {
        return $this->belongsTo(group::class,);
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", 'id');
    }

    public function post()
    {
        return $this->belongsTo(user::class, "user_id", 'id');
    }
}
