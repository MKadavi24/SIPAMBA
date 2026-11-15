<?php

namespace App\Http\Controllers;

use App\Models\LaporanMonitoring;
use App\Models\Pembangunan;
use Illuminate\Http\Request;
use App\Exports\LaporanMonitoringExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanMonitoringController extends Controller
{
    // Menampilkan seluruh laporan
    public function index()
    {
        $laporans = LaporanMonitoring::with('pembangunan')
            ->latest()
            ->paginate(10);

        return view('laporan-monitoring.index', compact('laporans'));
    }

    // Menampilkan formulir tambah laporan
    public function create()
    {
        $pembangunans = Pembangunan::orderBy('nama_pembangunan')->get();

        return view('laporan-monitoring.create', compact('pembangunans'));
    }

    // Menyimpan laporan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pembangunan_id' => 'required|exists:pembangunans,id',
            'tanggal_laporan' => 'required|date',
            'periode_laporan' => 'nullable|string|max:100',
            'sumber_informasi' => 'required|string|max:255',
            'nomor_dokumen' => 'nullable|string|max:255',
            'ringkasan' => 'required|string',
            'progres_dilaporkan' => 'nullable|numeric|min:0|max:100',
            'catatan_tindak_lanjut' => 'nullable|string',
            'status_tindak_lanjut' => 'required|in:belum_ditindaklanjuti,dalam_proses,selesai',
        ]);

        LaporanMonitoring::create($validated);

        return redirect()
            ->route('laporan-monitoring.index')
            ->with('success', 'Laporan monitoring berhasil disimpan.');
    }

    // Menampilkan detail laporan
    public function show(LaporanMonitoring $laporanMonitoring)
    {
        $laporanMonitoring->load('pembangunan');

        return view('laporan-monitoring.show', compact('laporanMonitoring'));
    }

    // Menampilkan formulir edit
    public function edit(LaporanMonitoring $laporanMonitoring)
    {
        $pembangunans = Pembangunan::orderBy('nama_pembangunan')->get();

        return view('laporan-monitoring.edit', compact(
            'laporanMonitoring',
            'pembangunans'
        ));
    }

    // Memperbarui laporan
    public function update(Request $request, LaporanMonitoring $laporanMonitoring)
    {
        $validated = $request->validate([
            'pembangunan_id' => 'required|exists:pembangunans,id',
            'tanggal_laporan' => 'required|date',
            'periode_laporan' => 'nullable|string|max:100',
            'sumber_informasi' => 'required|string|max:255',
            'nomor_dokumen' => 'nullable|string|max:255',
            'ringkasan' => 'required|string',
            'progres_dilaporkan' => 'nullable|numeric|min:0|max:100',
            'catatan_tindak_lanjut' => 'nullable|string',
            'status_tindak_lanjut' => 'required|in:belum_ditindaklanjuti,dalam_proses,selesai',
        ]);

        $laporanMonitoring->update($validated);

        return redirect()
            ->route('laporan-monitoring.index')
            ->with('success', 'Laporan monitoring berhasil diperbarui.');
    }

    // Menghapus laporan
    public function destroy(LaporanMonitoring $laporanMonitoring)
    {
        $laporanMonitoring->delete();

        return redirect()
            ->route('laporan-monitoring.index')
            ->with('success', 'Laporan monitoring berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(
            new LaporanMonitoringExport,
            'laporan-monitoring-sipamba.xlsx'
        );
    }

    public function exportPdf()
    {
        $laporan = LaporanMonitoring::with('pembangunan')
            ->orderBy('tanggal_laporan', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'pdf.laporan-monitoring',
            compact('laporan')
        )->setPaper('a4', 'landscape');

        return $pdf->download(
            'laporan-monitoring-sipamba.pdf'
        );
    }

}
