<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'angkatan',
        'dosen_wali_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function dosenWali(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dosen_wali_id');
    }

    public function mahasiswas(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
