<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanMbti extends Model
{
    protected $fillable = ['user_id', 'soal_mbti_id', 'pilihan'];

    public function soalMbti()
    {
        return $this->belongsTo(SoalMbti::class, 'soal_mbti_id');
    }
}
