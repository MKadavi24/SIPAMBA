
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Laporan Monitoring
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow-sm">

                <form action="{{ route('laporan-monitoring.update', $laporanMonitoring->id) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                        <label class="mb-2 block text-sm font-medium text-gray-700">Data Pembangunan</label>
                        <select name="pembangunan_id" required class="w-full rounded-lg border-gray-300">
                            @foreach ($pembangunans as $pembangunan)
                                <option value="{{ $pembangunan->id }}"
                                    {{ old('pembangunan_id', $laporanMonitoring->pembangunan_id) == $pembangunan->id ? 'selected' : '' }}>
                                    {{ $pembangunan->nama_pembangunan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Tanggal Laporan</label>
                        <input type="date" name="tanggal_laporan"
                               value="{{ old('tanggal_laporan', $laporanMonitoring->tanggal_laporan->format('Y-m-d')) }}"
                               required class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Periode Laporan</label>
                        <input type="text" name="periode_laporan"
                               value="{{ old('periode_laporan', $laporanMonitoring->periode_laporan) }}"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Sumber Informasi</label>
                        <input type="text" name="sumber_informasi"
                               value="{{ old('sumber_informasi', $laporanMonitoring->sumber_informasi) }}"
                               required class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Nomor Dokumen</label>
                        <input type="text" name="nomor_dokumen"
                               value="{{ old('nomor_dokumen', $laporanMonitoring->nomor_dokumen) }}"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Ringkasan Laporan</label>
                        <textarea name="ringkasan" rows="4" required
                                  class="w-full rounded-lg border-gray-300">{{ old('ringkasan', $laporanMonitoring->ringkasan) }}</textarea>
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Progres yang Dilaporkan (%)</label>
                        <input type="number" name="progres_dilaporkan"
                               value="{{ old('progres_dilaporkan', $laporanMonitoring->progres_dilaporkan) }}"
                               min="0" max="100" step="0.01"
                               class="w-full rounded-lg border-gray-300">
                        <p class="mt-1 text-xs text-gray-500">
                            Isi berdasarkan angka progres dari sumber informasi resmi.
                        </p>
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Catatan Tindak Lanjut</label>
                        <textarea name="catatan_tindak_lanjut" rows="3"
                                  class="w-full rounded-lg border-gray-300">{{ old('catatan_tindak_lanjut', $laporanMonitoring->catatan_tindak_lanjut) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Status Tindak Lanjut</label>
                        <select name="status_tindak_lanjut" required class="w-full rounded-lg border-gray-300">
                            <option value="belum_ditindaklanjuti"
                                {{ old('status_tindak_lanjut', $laporanMonitoring->status_tindak_lanjut) == 'belum_ditindaklanjuti' ? 'selected' : '' }}>
                                Belum Ditindaklanjuti
                            </option>
                            <option value="dalam_proses"
                                {{ old('status_tindak_lanjut', $laporanMonitoring->status_tindak_lanjut) == 'dalam_proses' ? 'selected' : '' }}>
                                Dalam Proses
                            </option>
                            <option value="selesai"
                                {{ old('status_tindak_lanjut', $laporanMonitoring->status_tindak_lanjut) == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('laporan-monitoring.index') }}"
                           class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>

                        <button type="submit"
                                class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                            Perbarui Laporan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
