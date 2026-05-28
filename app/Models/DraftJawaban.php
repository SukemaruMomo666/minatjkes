<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DraftJawaban extends Model
{
    protected $fillable = ['user_id', 'soal_id', 'jawaban'];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
