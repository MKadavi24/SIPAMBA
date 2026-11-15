
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Laporan Monitoring
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow-sm">

                <h3 class="mb-6 text-lg font-bold text-gray-800">
                    Informasi Laporan
                </h3>

                <div class="space-y-5">
                    <div>
                        <p class="text-sm text-gray-500">Nama Pembangunan</p>
                        <p class="font-semibold text-gray-800">
                            {{ $laporanMonitoring->pembangunan?->nama_pembangunan ?? 'Data pembangunan tidak tersedia' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tanggal Laporan</p>
                        <p class="font-medium text-gray-800">
                            {{ $laporanMonitoring->tanggal_laporan->format('d-m-Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Periode Laporan</p>
                        <p class="font-medium text-gray-800">
                            {{ $laporanMonitoring->periode_laporan ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Sumber Informasi</p>
                        <p class="font-medium text-gray-800">
                            {{ $laporanMonitoring->sumber_informasi }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Nomor Dokumen</p>
                        <p class="font-medium text-gray-800">
                            {{ $laporanMonitoring->nomor_dokumen ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Ringkasan Laporan</p>
                        <p class="whitespace-pre-line text-gray-800">
                            {{ $laporanMonitoring->ringkasan }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Progres yang Dilaporkan</p>
                        <p class="font-medium text-gray-800">
                            {{ $laporanMonitoring->progres_dilaporkan !== null ? $laporanMonitoring->progres_dilaporkan . '%' : 'Tidak dicantumkan' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Catatan Tindak Lanjut</p>
                        <p class="whitespace-pre-line text-gray-800">
                            {{ $laporanMonitoring->catatan_tindak_lanjut ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Status Tindak Lanjut</p>
                        @if ($laporanMonitoring->status_tindak_lanjut === 'belum_ditindaklanjuti')
                            <span class="inline-block rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                Belum Ditindaklanjuti
                            </span>
                        @elseif ($laporanMonitoring->status_tindak_lanjut === 'dalam_proses')
                            <span class="inline-block rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                Dalam Proses
                            </span>
                        @else
                            <span class="inline-block rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Selesai
                            </span>
                        @endif
                    </div>
                </div>

                <<div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('laporan-monitoring.index') }}"
                        class="rounded-lg border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Kembali
                    </a>

                    <a href="{{ route('laporan-monitoring.edit', $laporanMonitoring->id) }}"
                        style="background-color: #2563eb; color: white;"
                        class="rounded-lg px-5 py-3 text-sm font-semibold shadow-sm hover:opacity-90">
                        Edit Laporan
                    </a>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
