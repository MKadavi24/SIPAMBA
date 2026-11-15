
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Riwayat dan Tindak Lanjut Pengawasan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif
            <!-- HEADER RIWAYAT PENGAWASAN -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        Riwayat Pengawasan
                    </h2>

                    <p class="mt-2 text-gray-500">
                        Riwayat tindak lanjut pengawasan pembangunan.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">

                    <a href="{{ route('riwayat-tindak-lanjut.create') }}"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl
                            bg-blue-700 text-white font-semibold text-sm
                            hover:bg-blue-800 transition shadow-sm">
                        + Tambah Riwayat
                    </a>

                    
                    <a href="{{ route('riwayat-tindak-lanjut.export.excel') }}"
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


                    <a href="{{ route('riwayat-tindak-lanjut.export.pdf') }}"
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
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-500">No.</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-500">Pembangunan</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-500">Tanggal</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-500">Status</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-500">Dicatat Oleh</th>
                                <th class="px-5 py-3 text-center text-xs font-semibold uppercase text-gray-500">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse ($riwayat as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-5 py-4 text-sm text-gray-600">
                                        {{ $riwayat->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-5 py-4 text-sm font-medium text-gray-800">
                                        {{ $item->laporanMonitoring?->pembangunan?->nama_pembangunan ?? 'Data tidak tersedia' }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-gray-600">
                                        {{ $item->tanggal_tindak_lanjut?->format('d-m-Y') }}
                                    </td>

                                    <td class="px-5 py-4 text-sm">
                                        @php
                                            $warna = [
                                                'belum_ditindaklanjuti' => 'bg-red-100 text-red-700',
                                                'dalam_proses' => 'bg-yellow-100 text-yellow-700',
                                                'selesai' => 'bg-green-100 text-green-700',
                                            ];
                                            $label = [
                                                'belum_ditindaklanjuti' => 'Belum Ditindaklanjuti',
                                                'dalam_proses' => 'Dalam Proses',
                                                'selesai' => 'Selesai',
                                            ];
                                        @endphp

                                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $warna[$item->status] ?? 'bg-gray-100 text-gray-700' }}">
                                            {{ $label[$item->status] ?? $item->status }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4 text-sm text-gray-600">
                                        {{ $item->user?->name ?? 'Tidak diketahui' }}
                                    </td>

                                    <td class="px-5 py-4 text-center">
                                        <a href="{{ route('riwayat-tindak-lanjut.show', $item->id) }}"
                                           class="font-semibold text-indigo-700 hover:text-indigo-900">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-8 text-center text-sm text-gray-500">
                                        Belum ada riwayat tindak lanjut.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-100 p-4">
                    {{ $riwayat->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
