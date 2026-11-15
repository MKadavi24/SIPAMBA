
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Tambah Riwayat Tindak Lanjut
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-xl bg-white p-6 shadow-sm">
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">
                        Form Pencatatan Tindak Lanjut
                    </h3>
                    <p class="text-sm text-gray-500">
                        Isi berdasarkan informasi atau dokumen yang tersedia.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-5 rounded-lg bg-red-100 p-4 text-sm text-red-700">
                        <p class="mb-2 font-semibold">Periksa kembali isian berikut:</p>
                        <ul class="list-inside list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('riwayat-tindak-lanjut.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Laporan Monitoring
                        </label>
                        <select name="laporan_monitoring_id" required
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih Laporan Monitoring --</option>
                            @foreach ($laporan as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('laporan_monitoring_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->pembangunan?->nama_pembangunan ?? 'Pembangunan tidak tersedia' }}
                                    — {{ $item->tanggal_laporan?->format('d-m-Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Tanggal Tindak Lanjut
                        </label>
                        <input type="date" name="tanggal_tindak_lanjut"
                               value="{{ old('tanggal_tindak_lanjut', date('Y-m-d')) }}"
                               required
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Status Tindak Lanjut
                        </label>
                        <select name="status" required
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih Status --</option>
                            <option value="belum_ditindaklanjuti" {{ old('status') == 'belum_ditindaklanjuti' ? 'selected' : '' }}>
                                Belum Ditindaklanjuti
                            </option>
                            <option value="dalam_proses" {{ old('status') == 'dalam_proses' ? 'selected' : '' }}>
                                Dalam Proses
                            </option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Catatan Tindak Lanjut
                        </label>
                        <textarea name="catatan" rows="5" required
                                  placeholder="Tuliskan perkembangan, hasil koordinasi, atau informasi tindak lanjut berdasarkan sumber yang tersedia..."
                                  class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('catatan') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Sumber Informasi
                        </label>
                        <input type="text" name="sumber_informasi"
                               value="{{ old('sumber_informasi') }}"
                               placeholder="Contoh: Surat resmi, laporan instansi, atau hasil rapat"
                               class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="flex flex-wrap justify-end gap-3">
                        <a href="{{ route('riwayat-tindak-lanjut.index') }}"
                           class="rounded-lg border border-gray-300 px-5 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>

                        <button type="submit"
                                class="rounded-lg bg-indigo-700 px-5 py-2 text-sm font-semibold text-white hover:bg-indigo-800">
                            Simpan Riwayat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
