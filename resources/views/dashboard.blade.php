<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                Dashboard SIPAMBA
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Ringkasan Informasi Pengawasan dan Monitoring Pembangunan
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">

        <!-- Sambutan -->
        <div class="overflow-hidden rounded-2xl bg-gradient-to-r from-blue-900 to-blue-600 p-7 text-white shadow-lg">
            <p class="text-sm text-blue-100">
                Selamat datang di SIPAMBA
            </p>

            <h3 class="mt-2 text-3xl font-bold">
                Halo, {{ Auth::user()->name }}!
            </h3>

            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-blue-100">
                Pantau informasi, dokumentasi, dan tindak lanjut pengawasan
                pembangunan melalui satu sistem informasi.
            </p>
        </div>

        <!-- Kartu Statistik -->
        <section>
            <h3 class="mb-4 text-lg font-bold text-gray-800">
                Ringkasan Data
            </h3>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

                <!-- Pembangunan -->
                <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Data Pembangunan</p>
                            <h4 class="mt-3 text-3xl font-bold text-gray-800">
                                {{ $totalPembangunan }}
                            </h4>
                        </div>
                        <div class="rounded-xl bg-blue-100 p-4 text-2xl">
                            🏗️
                        </div>
                    </div>
                    <a href="{{ route('pembangunan.index') }}"
                       class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:text-blue-800">
                        Lihat data →
                    </a>
                </div>

                <!-- Laporan -->
                <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Laporan Monitoring</p>
                            <h4 class="mt-3 text-3xl font-bold text-gray-800">
                                {{ $totalLaporan }}
                            </h4>
                        </div>
                        <div class="rounded-xl bg-green-100 p-4 text-2xl">
                            📋
                        </div>
                    </div>
                    <a href="{{ route('laporan-monitoring.index') }}"
                       class="mt-4 inline-block text-sm font-semibold text-green-600 hover:text-green-800">
                        Lihat laporan →
                    </a>
                </div>

                <!-- Tindak Lanjut -->
                <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Perlu Tindak Lanjut</p>
                            <h4 class="mt-3 text-3xl font-bold text-gray-800">
                                {{ $perluTindakLanjut }}
                            </h4>
                        </div>
                        <div class="rounded-xl bg-orange-100 p-4 text-2xl">
                            ⏳
                        </div>
                    </div>
                    <a href="{{ route('laporan-monitoring.index') }}"
                       class="mt-4 inline-block text-sm font-semibold text-orange-600 hover:text-orange-800">
                        Lihat tindak lanjut →
                    </a>
                </div>

                <!-- Dokumentasi -->
                <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Dokumentasi</p>
                            <h4 class="mt-3 text-3xl font-bold text-gray-800">
                                {{ $totalDokumentasi }}
                            </h4>
                        </div>
                        <div class="rounded-xl bg-purple-100 p-4 text-2xl">
                            📷
                        </div>
                    </div>
                    <a href="{{ route('dokumentasi.index') }}"
                       class="mt-4 inline-block text-sm font-semibold text-purple-600 hover:text-purple-800">
                        Lihat dokumentasi →
                    </a>
                </div>

            </div>
        </section>

        <!-- Grafik -->
        <section>
            <h3 class="mb-4 text-lg font-bold text-gray-800">
                Analisis Data
            </h3>

            <div class="grid grid-cols-1 gap-5 xl:grid-cols-2">

                <!-- Grafik Pembangunan -->
                <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                    <h4 class="font-bold text-gray-800">
                        Jumlah Pembangunan per Tahun
                    </h4>
                    <p class="mb-5 mt-1 text-xs text-gray-500">
                        Berdasarkan tahun anggaran pada data pembangunan
                    </p>
                    <div class="relative h-72">
                        <canvas id="grafikPembangunan"></canvas>
                    </div>
                </div>

                <!-- Grafik Status -->
                <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
                    <h4 class="font-bold text-gray-800">
                        Status Tindak Lanjut
                    </h4>
                    <p class="mb-5 mt-1 text-xs text-gray-500">
                        Distribusi status laporan monitoring
                    </p>
                    <div class="relative h-72">
                        <canvas id="grafikStatus"></canvas>
                    </div>
                </div>

            </div>
        </section>

        <!-- Laporan Terbaru -->
        <section class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">

            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-gray-100 p-5">
                <div>
                    <h3 class="font-bold text-gray-800">
                        Laporan Monitoring Terbaru
                    </h3>
                    <p class="mt-1 text-xs text-gray-500">
                        Lima laporan terakhir yang tercatat
                    </p>
                </div>

                <a href="{{ route('laporan-monitoring.index') }}"
                   class="rounded-lg bg-blue-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-blue-700">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-5 py-4">No.</th>
                            <th class="px-5 py-4">Pembangunan</th>
                            <th class="px-5 py-4">Tanggal</th>
                            <th class="px-5 py-4">Progres Dilaporkan</th>
                            <th class="px-5 py-4">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($laporanTerbaru as $laporan)
                            <tr class="transition hover:bg-gray-50">
                                <td class="px-5 py-4 text-gray-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-5 py-4 font-medium text-gray-800">
                                    {{ $laporan->pembangunan?->nama_pembangunan ?? 'Data pembangunan tidak tersedia' }}
                                </td>

                                <td class="px-5 py-4 text-gray-600">
                                    {{ $laporan->tanggal_laporan?->format('d/m/Y') ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-gray-600">
                                    @if ($laporan->progres_dilaporkan !== null)
                                        {{ number_format((float) $laporan->progres_dilaporkan, 2, ',', '.') }}%
                                    @else
                                        <span class="text-gray-400">Tidak dicantumkan</span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    @if ($laporan->status_tindak_lanjut === 'selesai')
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                            Selesai
                                        </span>
                                    @elseif ($laporan->status_tindak_lanjut === 'dalam_proses')
                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                            Dalam Proses
                                        </span>
                                    @else
                                        <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                                            Belum Ditindaklanjuti
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-10 text-center text-gray-500">
                                    Belum ada laporan monitoring.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <p class="pb-2 text-center text-xs text-gray-400">
            SIPAMBA — Sistem Informasi Pengawasan dan Monitoring Pembangunan
        </p>

    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const tahunLabels = @json(
                $pembangunanPerTahun->pluck('tahun_anggaran')->map(fn($tahun) => (string) $tahun)->values()
            );

            const pembangunanData = @json(
                $pembangunanPerTahun->pluck('total')->values()
            );

            const statusAsli = @json(
                $laporanPerStatus->pluck('status_tindak_lanjut')->values()
            );

            const statusLabels = statusAsli.map(function (status) {
                const labels = {
                    belum_ditindaklanjuti: 'Belum Ditindaklanjuti',
                    dalam_proses: 'Dalam Proses',
                    selesai: 'Selesai'
                };

                return labels[status] || status;
            });

            const statusData = @json(
                $laporanPerStatus->pluck('total')->values()
            );

            // Grafik pembangunan
            new Chart(document.getElementById('grafikPembangunan'), {
                type: 'bar',
                data: {
                    labels: tahunLabels,
                    datasets: [{
                        label: 'Jumlah Pembangunan',
                        data: pembangunanData,
                        backgroundColor: '#3155C6',
                        borderRadius: 7,
                        maxBarThickness: 55
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Grafik status tindak lanjut
            new Chart(document.getElementById('grafikStatus'), {
                type: 'doughnut',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        data: statusData,
                        backgroundColor: [
                            '#F59E0B',
                            '#3B82F6',
                            '#10B981'
                        ],
                        borderWidth: 2,
                        borderColor: '#FFFFFF'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

        });
    </script>

</x-app-layout>
