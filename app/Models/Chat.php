<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'from_id',
        'to_id',
        'message',
        'attachment',
        'seen',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id', 'id')->select(['id', 'name']);
    }
    public function to()
    {
        return $this->belongsTo(User::class, 'to_id')->select(['id', 'name']);
    }
}
