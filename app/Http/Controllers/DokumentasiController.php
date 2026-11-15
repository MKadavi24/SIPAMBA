<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Models\Pembangunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    public function index()
    {
        $dokumentasis = Dokumentasi::with('pembangunan')
            ->latest()
            ->paginate(10);

        return view('dokumentasi.index', compact('dokumentasis'));
    }

    public function create()
    {
        $pembangunans = Pembangunan::orderBy('nama_pembangunan')->get();

        return view('dokumentasi.create', compact('pembangunans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pembangunan_id' => 'required|exists:pembangunans,id',
            'judul' => 'required|string|max:255',
            'tanggal_dokumentasi' => 'required|date',
            'file_dokumentasi' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sumber_dokumentasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $validated['file_path'] = $request->file('file_dokumentasi')
            ->store('dokumentasi', 'public');

        unset($validated['file_dokumentasi']);

        Dokumentasi::create($validated);

        return redirect()
            ->route('dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil disimpan.');
    }

    public function show(Dokumentasi $dokumentasi)
    {
        $dokumentasi->load('pembangunan');

        return view('dokumentasi.show', compact('dokumentasi'));
    }

    public function edit(Dokumentasi $dokumentasi)
    {
        $pembangunans = Pembangunan::orderBy('nama_pembangunan')->get();

        return view('dokumentasi.edit', compact(
            'dokumentasi',
            'pembangunans'
        ));
    }

    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        $validated = $request->validate([
            'pembangunan_id' => 'required|exists:pembangunans,id',
            'judul' => 'required|string|max:255',
            'tanggal_dokumentasi' => 'required|date',
            'file_dokumentasi' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sumber_dokumentasi' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file_dokumentasi')) {
            Storage::disk('public')->delete($dokumentasi->file_path);

            $validated['file_path'] = $request->file('file_dokumentasi')
                ->store('dokumentasi', 'public');
        }

        unset($validated['file_dokumentasi']);

        $dokumentasi->update($validated);

        return redirect()
            ->route('dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    public function destroy(Dokumentasi $dokumentasi)
    {
        Storage::disk('public')->delete($dokumentasi->file_path);

        $dokumentasi->delete();

        return redirect()
            ->route('dokumentasi.index')
            ->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
