
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Data Pembangunan
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Pengelolaan informasi pembangunan untuk mendukung fungsi pengawasan.
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            
            <!-- HEADER DATA PEMBANGUNAN -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">

                <!-- JUDUL -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Daftar Pembangunan
                    </h2>

                    <p class="mt-2 text-gray-500">
                        Total {{ $pembangunans->total() }} data tercatat.
                    </p>
                </div>

                <!-- TOMBOL AKSI -->
                <div class="flex flex-wrap items-center gap-3">

                    <a href="{{ route('pembangunan.create') }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl
                            bg-blue-700 text-white font-semibold text-sm
                            hover:bg-blue-800 transition shadow-sm">
                        + Tambah Data
                    </a>

                    
                    <a href="{{ route('pembangunan.export.excel') }}"
                    style="
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        padding: 12px 22px;
                        background-color: #16a34a !important;
                        color: #ffffff !important;
                        opacity: 1 !important;
                        border: 1px solid #16a34a;
                        border-radius: 12px;
                        font-size: 14px;
                        font-weight: 600;
                        text-decoration: none;
                        cursor: pointer;
                    ">
                        Ekspor Excel
                    </a>


                    <a href="{{ route('pembangunan.export.pdf') }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl
                            bg-red-600 text-white font-semibold text-sm
                            hover:bg-red-700 transition shadow-sm">
                        Cetak PDF
                    </a>

                </div>

            </div>



            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Pencarian dan Filter --}}
            <div class="rounded-xl bg-white p-5 shadow-sm">

                <form action="{{ route('pembangunan.index') }}"
                      method="GET"
                      class="grid grid-cols-1 gap-4 md:grid-cols-4">

                    {{-- Pencarian --}}
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Cari Pembangunan
                        </label>

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari nama atau lokasi pembangunan..."
                               class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    {{-- Filter kategori --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Kategori
                        </label>

                        <select name="kategori"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Semua Kategori</option>

                            @foreach (['Infrastruktur', 'Pekerjaan Umum', 'Perumahan', 'Lingkungan Hidup'] as $kategori)
                                <option value="{{ $kategori }}"
                                    {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                    {{ $kategori }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Filter tahun --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-gray-700">
                            Tahun Anggaran
                        </label>

                        <select name="tahun"
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Semua Tahun</option>

                            @foreach ($tahunList as $tahun)
                                <option value="{{ $tahun }}"
                                    {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Tombol pencarian --}}
                    <div class="flex flex-wrap gap-2 md:col-span-4">

                        <button type="submit"
                                style="background-color: #1d4ed8; color: white;"
                                class="rounded-lg px-5 py-2.5 text-sm font-semibold hover:opacity-90">
                            Cari Data
                        </button>

                        <a href="{{ route('pembangunan.index') }}"
                           class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Reset Filter
                        </a>

                    </div>

                </form>
            </div>

            {{-- Tabel Data Pembangunan --}}
            <div class="overflow-hidden rounded-xl bg-white shadow-sm">

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">

                        <thead class="bg-gray-50 text-xs uppercase text-gray-600">
                            <tr>
                                <th class="px-6 py-4">No.</th>
                                <th class="px-6 py-4">Nama Pembangunan</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Lokasi</th>
                                <th class="px-6 py-4">Tahun</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse ($pembangunans as $index => $item)

                                <tr class="transition hover:bg-gray-50">

                                    {{-- Nomor --}}
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $pembangunans->firstItem() + $index }}
                                    </td>

                                    {{-- Nama pembangunan --}}
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-gray-800">
                                            {{ $item->nama_pembangunan }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $item->instansi_pelaksana ?? 'Instansi belum dicatat' }}
                                        </p>
                                    </td>

                                    {{-- Kategori --}}
                                    <td class="px-6 py-4">
                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                                            {{ $item->kategori }}
                                        </span>
                                    </td>

                                    {{-- Lokasi --}}
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $item->lokasi }}
                                    </td>

                                    {{-- Tahun --}}
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $item->tahun_anggaran ?? '-' }}
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">

                                            <a href="{{ route('pembangunan.show', $item->id) }}"
                                               class="font-medium text-blue-600 hover:text-blue-800">
                                                Detail
                                            </a>

                                            <a href="{{ route('pembangunan.edit', $item->id) }}"
                                               class="font-medium text-amber-600 hover:text-amber-800">
                                                Edit
                                            </a>

                                            <form action="{{ route('pembangunan.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="font-medium text-red-600 hover:text-red-800">
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">

                                        <div class="text-4xl">🏗️</div>

                                        @if (request()->hasAny(['search', 'kategori', 'tahun']))
                                            <p class="mt-3 font-semibold text-gray-700">
                                                Data tidak ditemukan
                                            </p>

                                            <p class="mt-1 text-sm text-gray-500">
                                                Tidak ada data yang sesuai dengan pencarian atau filter.
                                            </p>
                                        @else
                                            <p class="mt-3 font-semibold text-gray-700">
                                                Belum ada data pembangunan
                                            </p>

                                            <p class="mt-1 text-sm text-gray-500">
                                                Silakan tambahkan data berdasarkan dokumen atau sumber informasi resmi.
                                            </p>
                                        @endif

                                        <a href="{{ route('pembangunan.create') }}"
                                           style="background-color: #1d4ed8; color: white;"
                                           class="mt-5 inline-flex rounded-lg px-4 py-2 text-sm font-semibold hover:opacity-90">
                                            Tambah Data
                                        </a>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($pembangunans->hasPages())
                    <div class="border-t border-gray-100 px-6 py-4">
                        {{ $pembangunans->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
