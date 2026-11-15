
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Dokumentasi
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow-sm">

                <form action="{{ route('dokumentasi.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
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
                            Judul Dokumentasi
                        </label>
                        <input type="text" name="judul"
                               value="{{ old('judul') }}" required
                               placeholder="Contoh: Dokumentasi kondisi pembangunan"
                               class="w-full rounded-lg border-gray-300">
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Tanggal Dokumentasi
                        </label>
                        <input type="date" name="tanggal_dokumentasi"
                               value="{{ old('tanggal_dokumentasi') }}" required
                               class="w-full rounded-lg border-gray-300">
                        @error('tanggal_dokumentasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Upload Foto Dokumentasi
                        </label>
                        <input type="file" name="file_dokumentasi"
                               accept=".jpg,.jpeg,.png,.webp" required
                               class="w-full rounded-lg border border-gray-300 p-3">
                        <p class="mt-1 text-xs text-gray-500">
                            Format JPG, JPEG, PNG, WEBP. Maksimal 5 MB.
                        </p>
                        @error('file_dokumentasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Sumber Dokumentasi
                        </label>
                        <input type="text" name="sumber_dokumentasi"
                               value="{{ old('sumber_dokumentasi') }}" required
                               placeholder="Contoh: Dokumentasi instansi terkait"
                               class="w-full rounded-lg border-gray-300">
                        @error('sumber_dokumentasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Keterangan
                        </label>
                        <textarea name="keterangan" rows="4"
                                  class="w-full rounded-lg border-gray-300"
                                  placeholder="Tuliskan keterangan foto...">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('dokumentasi.index') }}"
                           class="rounded-lg border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>

                        <button type="submit"
                                style="background-color: #2563eb; color: white;"
                                class="rounded-lg px-5 py-3 text-sm font-semibold shadow-sm hover:opacity-90">
                            Simpan Dokumentasi
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
