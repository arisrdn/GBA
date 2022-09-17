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

    public function user()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id')->select(['id', 'name']);
    }
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id')->get('name');
    }
}
