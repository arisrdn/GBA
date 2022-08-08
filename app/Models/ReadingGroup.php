<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'reading_plan',

    ];

    public function groupMember()
    {
        return $this->hasMany(ReadingGroupMember::class);
    }
    public function groupActivity()
    {
        return $this->hasMany(ReadingGroupActivity::class);
    }
}
