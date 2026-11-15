<?php

namespace App\Exports;

use App\Models\Pembangunan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PembangunanExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Pembangunan::orderBy('tahun_anggaran', 'desc')
            ->orderBy('nama_pembangunan', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pembangunan',
            'Kategori',
            'Lokasi',
            'Tahun Anggaran',
            'Instansi Pelaksana',
            'Sumber Informasi',
            'Tanggal Data',
            'Keterangan',
        ];
    }

    public function map($pembangunan): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $pembangunan->nama_pembangunan,
            $pembangunan->kategori,
            $pembangunan->lokasi,
            $pembangunan->tahun_anggaran,
            $pembangunan->instansi_pelaksana,
            $pembangunan->sumber_informasi,
            $pembangunan->tanggal_data,
            $pembangunan->keterangan,
        ];
    }
}
