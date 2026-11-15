<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaporanMonitoring extends Model
{
    protected $table = 'laporan_monitorings';

    protected $fillable = [
        'pembangunan_id',
        'tanggal_laporan',
        'periode_laporan',
        'sumber_informasi',
        'nomor_dokumen',
        'ringkasan',
        'progres_dilaporkan',
        'catatan_tindak_lanjut',
        'status_tindak_lanjut',
    ];

    protected $casts = [
        'tanggal_laporan' => 'date',
        'progres_dilaporkan' => 'decimal:2',
    ];

    public function pembangunan(): BelongsTo
    {
        return $this->belongsTo(Pembangunan::class);
    }

    public function riwayatTindakLanjut(): HasMany
    {
        return $this->hasMany(
            RiwayatTindakLanjut::class,
            'laporan_monitoring_id'
        )->orderBy('tanggal_tindak_lanjut', 'desc')
        ->orderBy('id', 'desc');
    }
    
}
