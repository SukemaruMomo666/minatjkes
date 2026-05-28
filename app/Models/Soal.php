<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $fillable = [
        'kategori_id', 'tipe', 'teks_soal', 'dimensi_mbti', 
        'opsi_a', 'opsi_b', 'bobot', 'is_active'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
