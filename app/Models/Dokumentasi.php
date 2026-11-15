<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumentasi extends Model
{
    protected $table = 'dokumentasis';

    protected $fillable = [
        'pembangunan_id',
        'user_id',
        'judul',
        'jenis_dokumentasi',
        'tanggal_dokumentasi',
        'nama_file',
        'file_path',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_dokumentasi' => 'date',
    ];

    public function pembangunan(): BelongsTo
    {
        return $this->belongsTo(Pembangunan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
