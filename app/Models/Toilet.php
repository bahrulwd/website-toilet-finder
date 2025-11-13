<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toilet extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'facilities' => 'array',
        'access' => 'array',
        'images' => 'array',
        'rating' => 'float', // <-- tambahkan ini
    ];

    public function reviews() {
        return $this->hasMany(Review::class);
    }
    protected $attributes = [
        'images' => '["images/image1.png","images/image2.png"]',
    ];

    public function getRatingStars()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            $stars .= '<i class="fas fa-star ' . ($this->rating >= $i ? 'text-yellow-400' : 'text-slate-300') . '"></i>';
        }
        return $stars;
    }
}