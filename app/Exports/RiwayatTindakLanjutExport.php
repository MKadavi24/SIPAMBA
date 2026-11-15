<?php

namespace App\Exports;

use App\Models\RiwayatTindakLanjut;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RiwayatTindakLanjutExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return RiwayatTindakLanjut::with([
            'laporanMonitoring.pembangunan',
            'user'
        ])
            ->orderBy('tanggal_tindak_lanjut', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pembangunan',
            'Tanggal Tindak Lanjut',
            'Status',
            'Catatan Tindak Lanjut',
            'Sumber Informasi',
            'Petugas Pencatat',
        ];
    }

    public function map($riwayat): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $riwayat->laporanMonitoring->pembangunan->nama_pembangunan ?? '-',
            $riwayat->tanggal_tindak_lanjut,
            $riwayat->status,
            $riwayat->catatan,
            $riwayat->sumber_informasi ?? '-',
            $riwayat->user->name ?? '-',
        ];
    }
}
