@php
    $data = $pembangunan ?? null;
    $kategoriTerpilih = old('kategori', $data->kategori ?? '');
@endphp

<div class="space-y-5">

    {{-- Nama pembangunan --}}
    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Nama Pembangunan *
        </label>

        <input type="text"
               name="nama_pembangunan"
               value="{{ old('nama_pembangunan', $data->nama_pembangunan ?? '') }}"
               required
               placeholder="Masukkan nama pembangunan"
               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

        @error('nama_pembangunan')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Kategori --}}
    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Kategori *
        </label>

        <select name="kategori"
                required
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

            <option value="">Pilih kategori</option>

            @foreach (['Infrastruktur', 'Pekerjaan Umum', 'Perumahan', 'Lingkungan Hidup'] as $kategori)
                <option value="{{ $kategori }}"
                    {{ $kategoriTerpilih === $kategori ? 'selected' : '' }}>
                    {{ $kategori }}
                </option>
            @endforeach
        </select>

        @error('kategori')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Lokasi --}}
    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Lokasi Pembangunan *
        </label>

        <textarea name="lokasi"
                  rows="2"
                  required
                  placeholder="Masukkan lokasi pembangunan"
                  class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('lokasi', $data->lokasi ?? '') }}</textarea>

        @error('lokasi')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tahun dan instansi --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Tahun Anggaran
            </label>

            <input type="number"
                   name="tahun_anggaran"
                   value="{{ old('tahun_anggaran', $data->tahun_anggaran ?? '') }}"
                   min="2000"
                   max="2100"
                   placeholder="Contoh: 2026"
                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

            @error('tahun_anggaran')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-semibold text-gray-700">
                Instansi Pelaksana
            </label>

            <input type="text"
                   name="instansi_pelaksana"
                   value="{{ old('instansi_pelaksana', $data->instansi_pelaksana ?? '') }}"
                   placeholder="Sesuai dokumen sumber"
                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

            @error('instansi_pelaksana')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Sumber informasi --}}
    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Sumber Informasi *
        </label>

        <textarea name="sumber_informasi"
                  rows="2"
                  required
                  placeholder="Contoh: nama dokumen, nomor laporan, atau sumber resmi"
                  class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('sumber_informasi', $data->sumber_informasi ?? '') }}</textarea>

        @error('sumber_informasi')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tanggal data --}}
    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Tanggal Dokumen / Informasi
        </label>

        <input type="date"
               name="tanggal_data"
               value="{{ old('tanggal_data', $data->tanggal_data ?? '') }}"
               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

        @error('tanggal_data')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Keterangan --}}
    <div>
        <label class="mb-2 block text-sm font-semibold text-gray-700">
            Keterangan Tambahan
        </label>

        <textarea name="keterangan"
                  rows="3"
                  placeholder="Masukkan catatan tambahan jika ada"
                  class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('keterangan', $data->keterangan ?? '') }}</textarea>

        @error('keterangan')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

</div>