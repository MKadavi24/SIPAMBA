<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Detail Pembangunan
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-xl bg-white p-6 shadow-sm sm:p-8">

                <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
                    <div>
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                            {{ $pembangunan->kategori }}
                        </span>

                        <h3 class="mt-4 text-xl font-bold text-gray-800">
                            {{ $pembangunan->nama_pembangunan }}
                        </h3>
                    </div>

                    <a href="{{ route('pembangunan.edit', $pembangunan->id) }}"
                       class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-600">
                        Edit Data
                    </a>
                </div>

                <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2">

                    <div>
                        <p class="text-sm text-gray-500">Lokasi</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $pembangunan->lokasi }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tahun Anggaran</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $pembangunan->tahun_anggaran ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Instansi Pelaksana</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $pembangunan->instansi_pelaksana ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tanggal Dokumen / Informasi</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $pembangunan->tanggal_data ?? '-' }}
                        </p>
                    </div>

                    <div class="sm:col-span-2">
                        <p class="text-sm text-gray-500">Sumber Informasi</p>
                        <p class="mt-1 font-semibold text-gray-800">
                            {{ $pembangunan->sumber_informasi }}
                        </p>
                    </div>

                    <div class="sm:col-span-2">
                        <p class="text-sm text-gray-500">Keterangan</p>
                        <p class="mt-1 whitespace-pre-line text-gray-800">
                            {{ $pembangunan->keterangan ?? 'Tidak ada keterangan.' }}
                        </p>
                    </div>

                </div>

                <div class="mt-8 border-t border-gray-100 pt-5">
                    <a href="{{ route('pembangunan.index') }}"
                       class="text-sm font-semibold text-blue-700 hover:text-blue-900">
                        ← Kembali ke Daftar Pembangunan
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>