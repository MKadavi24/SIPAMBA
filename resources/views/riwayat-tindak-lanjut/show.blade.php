
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Detail Riwayat Tindak Lanjut
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-xl bg-white p-6 shadow-sm">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">
                            Informasi Riwayat
                        </h3>
                        <p class="text-sm text-gray-500">
                            Rincian catatan tindak lanjut pengawasan.
                        </p>
                    </div>

                    <a href="{{ route('riwayat-tindak-lanjut.index') }}"
                       class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Kembali
                    </a>
                </div>

                <div class="space-y-5">
                    <div>
                        <p class="text-sm text-gray-500">Nama Pembangunan</p>
                        <p class="font-semibold text-gray-800">
                            {{ $riwayatTindakLanjut->laporanMonitoring?->pembangunan?->nama_pembangunan ?? 'Data tidak tersedia' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tanggal Laporan Monitoring</p>
                        <p class="font-semibold text-gray-800">
                            {{ $riwayatTindakLanjut->laporanMonitoring?->tanggal_laporan?->format('d-m-Y') ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tanggal Tindak Lanjut</p>
                        <p class="font-semibold text-gray-800">
                            {{ $riwayatTindakLanjut->tanggal_tindak_lanjut?->format('d-m-Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        @php
                            $label = [
                                'belum_ditindaklanjuti' => 'Belum Ditindaklanjuti',
                                'dalam_proses' => 'Dalam Proses',
                                'selesai' => 'Selesai',
                            ];
                        @endphp
                        <p class="font-semibold text-gray-800">
                            {{ $label[$riwayatTindakLanjut->status] ?? $riwayatTindakLanjut->status }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Catatan Tindak Lanjut</p>
                        <div class="mt-1 rounded-lg bg-gray-50 p-4 text-gray-700 whitespace-pre-line">
                            {{ $riwayatTindakLanjut->catatan }}
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Sumber Informasi</p>
                        <p class="font-medium text-gray-800">
                            {{ $riwayatTindakLanjut->sumber_informasi ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Dicatat Oleh</p>
                        <p class="font-medium text-gray-800">
                            {{ $riwayatTindakLanjut->user?->name ?? 'Tidak diketahui' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
