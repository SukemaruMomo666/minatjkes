<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalMbti extends Model
{
    use HasFactory;

    protected $fillable = [
        'dimensi',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'is_active',
    ];
}
