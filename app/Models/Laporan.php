<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'toilet_id',
        'deskripsi_laporan',
        'status_laporan',
        'tanggal_laporan',
        'soft_delete',
    ];

    public function toilet()
    {
        return $this->hasMany(Toilet::class);
    }
}
