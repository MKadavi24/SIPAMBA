<?php

namespace App\Http\Controllers;

use App\Models\Pembangunan;
use App\Models\LaporanMonitoring;
use App\Models\Dokumentasi;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalPembangunan = Pembangunan::count();

        $totalLaporan = LaporanMonitoring::count();

        $perluTindakLanjut = LaporanMonitoring::whereIn(
            'status_tindak_lanjut',
            ['belum_ditindaklanjuti', 'dalam_proses']
        )->count();

        $totalDokumentasi = Dokumentasi::count();

        // Grafik jumlah pembangunan berdasarkan tahun anggaran
        $pembangunanPerTahun = Pembangunan::selectRaw(
            'tahun_anggaran, COUNT(*) as total'
        )
            ->groupBy('tahun_anggaran')
            ->orderBy('tahun_anggaran')
            ->get();

        // Grafik status laporan monitoring
        $laporanPerStatus = LaporanMonitoring::selectRaw(
            'status_tindak_lanjut, COUNT(*) as total'
        )
            ->groupBy('status_tindak_lanjut')
            ->get();

        // Laporan monitoring terbaru
        $laporanTerbaru = LaporanMonitoring::with('pembangunan')
            ->orderByDesc('tanggal_laporan')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalPembangunan',
            'totalLaporan',
            'perluTindakLanjut',
            'totalDokumentasi',
            'pembangunanPerTahun',
            'laporanPerStatus',
            'laporanTerbaru'
        ));
    }
}
