<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'keyword',
        'waktu_pencarian',
        'soft_delete',
    ];

    public function toilet()
    {
        return $this->hasMany(Toilet::class);
    }
}
