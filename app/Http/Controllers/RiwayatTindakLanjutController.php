<?php

namespace App\Http\Controllers;

use App\Models\LaporanMonitoring;
use App\Models\RiwayatTindakLanjut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\RiwayatTindakLanjutExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatTindakLanjutController extends Controller
{
    public function index()
    {
        $riwayat = RiwayatTindakLanjut::with([
            'laporanMonitoring.pembangunan',
            'user'
        ])
        ->orderByDesc('tanggal_tindak_lanjut')
        ->orderByDesc('id')
        ->paginate(10);

        return view('riwayat-tindak-lanjut.index', compact('riwayat'));
    }

    public function create()
    {
        $laporan = LaporanMonitoring::with('pembangunan')
            ->latest('tanggal_laporan')
            ->get();

        return view('riwayat-tindak-lanjut.create', compact('laporan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'laporan_monitoring_id' => 'required|exists:laporan_monitorings,id',
            'tanggal_tindak_lanjut' => 'required|date',
            'status' => 'required|in:belum_ditindaklanjuti,dalam_proses,selesai',
            'catatan' => 'required|string',
            'sumber_informasi' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated) {
            RiwayatTindakLanjut::create([
                ...$validated,
                'user_id' => Auth::id(),
            ]);

            // Perbarui status terkini pada laporan monitoring.
            $laporan = LaporanMonitoring::findOrFail(
                $validated['laporan_monitoring_id']
            );

            $laporan->update([
                'status_tindak_lanjut' => $validated['status'],
            ]);
        });

        return redirect()
            ->route('riwayat-tindak-lanjut.index')
            ->with('success', 'Riwayat tindak lanjut berhasil ditambahkan.');
    }

    public function show(RiwayatTindakLanjut $riwayatTindakLanjut)
    {
        $riwayatTindakLanjut->load([
            'laporanMonitoring.pembangunan',
            'user'
        ]);

        return view(
            'riwayat-tindak-lanjut.show',
            compact('riwayatTindakLanjut')
        );
    }

    public function exportExcel()
    {
        return Excel::download(
            new RiwayatTindakLanjutExport,
            'riwayat-pengawasan-sipamba.xlsx'
        );
    }

    public function exportPdf()
    {
        $riwayat = RiwayatTindakLanjut::with([
            'laporanMonitoring.pembangunan',
            'user'
        ])
            ->orderBy('tanggal_tindak_lanjut', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'pdf.riwayat-pengawasan',
            compact('riwayat')
        )->setPaper('a4', 'landscape');

        return $pdf->download(
            'riwayat-pengawasan-sipamba.pdf'
        );
    }

}
