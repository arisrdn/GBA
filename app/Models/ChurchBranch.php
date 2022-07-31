<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChurchBranch extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'address',
        'church_id'
    ];

    public function church()
    {
        return $this->belongsTo(Church::class);
    
    }
    public function withChurch() {
        $this->belongsTo(Church::class)->with('church');
    }
}
