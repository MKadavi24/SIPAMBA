
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Laporan Monitoring
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow-sm">

                <form action="{{ route('laporan-monitoring.store') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-5 rounded-lg bg-red-100 p-4 text-red-700">
                            <p class="mb-2 font-semibold">Periksa kembali isian berikut:</p>
                            <ul class="list-inside list-disc text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Data Pembangunan
                        </label>
                        <select name="pembangunan_id" required
                                class="w-full rounded-lg border-gray-300">
                            <option value="">-- Pilih Pembangunan --</option>
                            @foreach ($pembangunans as $pembangunan)
                                <option value="{{ $pembangunan->id }}"
                                    {{ old('pembangunan_id') == $pembangunan->id ? 'selected' : '' }}>
                                    {{ $pembangunan->nama_pembangunan }}
                                </option>
                            @endforeach
                        </select>
                        @error('pembangunan_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Tanggal Laporan
                        </label>
                        <input type="date" name="tanggal_laporan"
                               value="{{ old('tanggal_laporan') }}" required
                               class="w-full rounded-lg border-gray-300">
                        @error('tanggal_laporan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Periode Laporan
                        </label>
                        <input type="text" name="periode_laporan"
                               value="{{ old('periode_laporan') }}"
                               placeholder="Contoh: Triwulan I 2026"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Sumber Informasi
                        </label>
                        <input type="text" name="sumber_informasi"
                               value="{{ old('sumber_informasi') }}" required
                               placeholder="Contoh: Laporan resmi instansi terkait"
                               class="w-full rounded-lg border-gray-300">
                        @error('sumber_informasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Nomor Dokumen (Opsional)
                        </label>
                        <input type="text" name="nomor_dokumen"
                               value="{{ old('nomor_dokumen') }}"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Ringkasan Laporan
                        </label>
                        <textarea name="ringkasan" rows="4" required
                                  class="w-full rounded-lg border-gray-300"
                                  placeholder="Tuliskan ringkasan berdasarkan dokumen atau informasi yang diterima...">{{ old('ringkasan') }}</textarea>
                        @error('ringkasan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Progres yang Dilaporkan (%)
                        </label>
                        <input type="number" name="progres_dilaporkan"
                               value="{{ old('progres_dilaporkan') }}"
                               min="0" max="100" step="0.01"
                               placeholder="Contoh: 45.50"
                               class="w-full rounded-lg border-gray-300">
                        <p class="mt-1 text-xs text-gray-500">
                            Isi hanya jika angka progres tercantum dalam sumber informasi resmi.
                        </p>
                        @error('progres_dilaporkan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Catatan Tindak Lanjut
                        </label>
                        <textarea name="catatan_tindak_lanjut" rows="3"
                                  class="w-full rounded-lg border-gray-300"
                                  placeholder="Catatan atau hal yang perlu ditindaklanjuti...">{{ old('catatan_tindak_lanjut') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Status Tindak Lanjut
                        </label>
                        <select name="status_tindak_lanjut" required
                                class="w-full rounded-lg border-gray-300">
                            <option value="belum_ditindaklanjuti"
                                {{ old('status_tindak_lanjut', 'belum_ditindaklanjuti') == 'belum_ditindaklanjuti' ? 'selected' : '' }}>
                                Belum Ditindaklanjuti
                            </option>
                            <option value="dalam_proses"
                                {{ old('status_tindak_lanjut') == 'dalam_proses' ? 'selected' : '' }}>
                                Dalam Proses
                            </option>
                            <option value="selesai"
                                {{ old('status_tindak_lanjut') == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('laporan-monitoring.index') }}"
                            class="rounded-lg border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>

                        <button type="submit"
                                style="background-color: #2563eb; color: white;"
                                class="rounded-lg px-5 py-3 text-sm font-semibold shadow-sm hover:opacity-90">
                            Simpan Laporan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
