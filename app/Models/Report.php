<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'toilet_id',
        'content',
        'status',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Toilet
    public function toilet()
    {
        return $this->belongsTo(Toilet::class);
    }
}