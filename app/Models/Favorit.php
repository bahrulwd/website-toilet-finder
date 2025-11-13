<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'toilet_id',
        'soft_delete',
    ];

    public function toilet()
    {
        return $this->hasMany(Toilet::class);
    }
}