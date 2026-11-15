<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembangunan extends Model
{
    protected $fillable = [
        'nama_pembangunan',
        'kategori',
        'lokasi',
        'tahun_anggaran',
        'instansi_pelaksana',
        'sumber_informasi',
        'tanggal_data',
        'keterangan',
    ];

    public function laporanMonitorings(): HasMany
    {
        return $this->hasMany(LaporanMonitoring::class);
    }

    public function dokumentasis(): HasMany
    {
        return $this->hasMany(Dokumentasi::class);
    }

}
