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
        return $this->belongsTo('User', 'sender_id');
    }
    public function to()
    {
        return $this->belongsTo('User', 'to_id');
    }
}
