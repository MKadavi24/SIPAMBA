<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Monitoring
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- HEADER LAPORAN MONITORING -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Laporan Monitoring
                    </h2>

                    <p class="mt-2 text-gray-500">
                        Data laporan monitoring pembangunan.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">

                    <a href="{{ route('laporan-monitoring.create') }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl
                            bg-blue-700 text-white font-semibold text-sm
                            hover:bg-blue-800 transition shadow-sm">
                        + Tambah Data
                    </a>

                    
                    <a href="{{ route('laporan-monitoring.export.excel') }}"
                    style="display:inline-flex;
                            align-items:center;
                            justify-content:center;
                            padding:12px 22px;
                            background:#16a34a !important;
                            color:#ffffff !important;
                            opacity:1 !important;
                            border:1px solid #16a34a;
                            border-radius:12px;
                            font-size:14px;
                            font-weight:600;
                            text-decoration:none;
                            cursor:pointer;">
                        Ekspor Excel
                    </a>


                    <a href="{{ route('laporan-monitoring.export.pdf') }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl
                            bg-red-600 text-white font-semibold text-sm
                            hover:bg-red-700 transition shadow-sm">
                        Cetak PDF
                    </a>

                </div>

            </div>



            <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">No.</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Pembangunan</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Tanggal</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Sumber Informasi</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Progres Dilaporkan</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Status Tindak Lanjut</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($laporans as $index => $laporan)
                                <tr>
                                    <td class="px-5 py-4 text-sm text-gray-700">
                                        {{ $laporans->firstItem() + $index }}
                                    </td>

                                    <td class="px-5 py-4 text-sm font-medium text-gray-800">
                                        {{ $laporan->pembangunan?->nama_pembangunan ?? 'Data pembangunan tidak tersedia' }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-gray-700">
                                        {{ $laporan->tanggal_laporan->format('d-m-Y') }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-gray-700">
                                        {{ $laporan->sumber_informasi }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-gray-700">
                                        {{ $laporan->progres_dilaporkan !== null ? $laporan->progres_dilaporkan . '%' : 'Tidak dicantumkan' }}
                                    </td>

                                    <td class="px-5 py-4 text-sm">
                                        @if ($laporan->status_tindak_lanjut === 'belum_ditindaklanjuti')
                                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                Belum Ditindaklanjuti
                                            </span>
                                        @elseif ($laporan->status_tindak_lanjut === 'dalam_proses')
                                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                Dalam Proses
                                            </span>
                                        @else
                                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Selesai
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4 text-sm">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('laporan-monitoring.show', $laporan->id) }}"
                                               class="font-medium text-blue-600 hover:underline">
                                                Detail
                                            </a>

                                            <a href="{{ route('laporan-monitoring.edit', $laporan->id) }}"
                                               class="font-medium text-yellow-600 hover:underline">
                                                Edit
                                            </a>

                                            <form action="{{ route('laporan-monitoring.destroy', $laporan->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="font-medium text-red-600 hover:underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-5 py-10 text-center text-sm text-gray-500">
                                        Belum ada laporan monitoring.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-5 py-4">
                    {{ $laporans->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
