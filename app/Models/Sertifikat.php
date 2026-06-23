<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sertifikat extends Model
{
    protected $fillable = [
        'user_id',
        'jenis',
        'nama_sertifikat',
        'file_path',
        'status',
        'verified_by',
        'verified_at',
        'catatan',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verifikator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
