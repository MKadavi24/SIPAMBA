<?php

namespace App\Http\Controllers;

use App\Models\Pembangunan;
use Illuminate\Http\Request;
use App\Exports\PembangunanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PembangunanController extends Controller
{
    // Menampilkan semua data
    public function index(Request $request)
    {
        $query = Pembangunan::query();

        // Pencarian nama pembangunan atau lokasi
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_pembangunan', 'like', "%{$search}%")
                ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter tahun anggaran
        if ($request->filled('tahun')) {
            $query->where('tahun_anggaran', $request->tahun);
        }

        // Ambil data dengan pagination
        $pembangunans = $query->latest()
            ->paginate(10)
            ->withQueryString();

        // Daftar tahun yang tersedia di database
        $tahunList = Pembangunan::whereNotNull('tahun_anggaran')
            ->distinct()
            ->orderByDesc('tahun_anggaran')
            ->pluck('tahun_anggaran');

        return view('pembangunan.index', compact(
            'pembangunans',
            'tahunList'
        ));
    }

    // Menampilkan formulir tambah data
    public function create()
    {
        return view('pembangunan.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pembangunan' => 'required|string|max:255',
            'kategori' => 'required|in:Infrastruktur,Pekerjaan Umum,Perumahan,Lingkungan Hidup',
            'lokasi' => 'required|string',
            'tahun_anggaran' => 'nullable|integer|min:2000|max:2100',
            'instansi_pelaksana' => 'nullable|string|max:255',
            'sumber_informasi' => 'required|string',
            'tanggal_data' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        Pembangunan::create($validated);

        return redirect()
            ->route('pembangunan.index')
            ->with('success', 'Data pembangunan berhasil ditambahkan.');
    }

    // Menampilkan detail data
    public function show(Pembangunan $pembangunan)
    {
        return view('pembangunan.show', compact('pembangunan'));
    }

    // Menampilkan formulir edit
    public function edit(Pembangunan $pembangunan)
    {
        return view('pembangunan.edit', compact('pembangunan'));
    }

    // Memperbarui data
    public function update(Request $request, Pembangunan $pembangunan)
    {
        $validated = $request->validate([
            'nama_pembangunan' => 'required|string|max:255',
            'kategori' => 'required|in:Infrastruktur,Pekerjaan Umum,Perumahan,Lingkungan Hidup',
            'lokasi' => 'required|string',
            'tahun_anggaran' => 'nullable|integer|min:2000|max:2100',
            'instansi_pelaksana' => 'nullable|string|max:255',
            'sumber_informasi' => 'required|string',
            'tanggal_data' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $pembangunan->update($validated);

        return redirect()
            ->route('pembangunan.index')
            ->with('success', 'Data pembangunan berhasil diperbarui.');
    }

    // Menghapus data
    public function destroy(Pembangunan $pembangunan)
    {
        $pembangunan->delete();

        return redirect()
            ->route('pembangunan.index')
            ->with('success', 'Data pembangunan berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(
            new PembangunanExport,
            'data-pembangunan-sipamba.xlsx'
        );
    }

    public function exportPdf()
    {
        $pembangunans = Pembangunan::orderBy('tahun_anggaran', 'desc')
            ->orderBy('nama_pembangunan', 'asc')
            ->get();

        $pdf = Pdf::loadView('pdf.pembangunan', compact('pembangunans'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-pembangunan-sipamba.pdf');
    }
    
}