<?php

namespace App\Exports;

use App\Models\LaporanMonitoring;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanMonitoringExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return LaporanMonitoring::with('pembangunan')
            ->orderBy('tanggal_laporan', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Pembangunan',
            'Tanggal Laporan',
            'Periode Laporan',
            'Sumber Informasi',
            'Nomor Dokumen',
            'Ringkasan',
            'Progres Dilaporkan (%)',
            'Catatan Tindak Lanjut',
            'Status Tindak Lanjut',
        ];
    }

    public function map($laporan): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $laporan->pembangunan->nama_pembangunan ?? '-',
            $laporan->tanggal_laporan,
            $laporan->periode_laporan,
            $laporan->sumber_informasi,
            $laporan->nomor_dokumen,
            $laporan->ringkasan,
            $laporan->progres_dilaporkan,
            $laporan->catatan_tindak_lanjut,
            $laporan->status_tindak_lanjut,
        ];
    }
}
