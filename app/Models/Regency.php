<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'province_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
