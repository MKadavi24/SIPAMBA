<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatTindakLanjut extends Model
{
    protected $table = 'riwayat_tindak_lanjuts';

    protected $fillable = [
        'laporan_monitoring_id',
        'user_id',
        'tanggal_tindak_lanjut',
        'status',
        'catatan',
        'sumber_informasi',
    ];

    protected $casts = [
        'tanggal_tindak_lanjut' => 'date',
    ];

    public function laporanMonitoring(): BelongsTo
    {
        return $this->belongsTo(
            LaporanMonitoring::class,
            'laporan_monitoring_id'
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
