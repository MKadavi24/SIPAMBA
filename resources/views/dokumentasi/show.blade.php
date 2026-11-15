
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Dokumentasi
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow-sm">

                <h3 class="mb-6 text-lg font-bold text-gray-800">
                    {{ $dokumentasi->judul }}
                </h3>

                <div class="mb-6">
                    <img src="{{ asset('storage/' . $dokumentasi->file_path) }}"
                         alt="{{ $dokumentasi->judul }}"
                         class="max-h-[500px] w-full rounded-xl object-contain bg-gray-50">
                </div>

                <div class="space-y-5">
                    <div>
                        <p class="text-sm text-gray-500">Nama Pembangunan</p>
                        <p class="font-medium text-gray-800">
                            {{ $dokumentasi->pembangunan?->nama_pembangunan ?? 'Data tidak tersedia' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tanggal Dokumentasi</p>
                        <p class="font-medium text-gray-800">
                            {{ $dokumentasi->tanggal_dokumentasi->format('d-m-Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Sumber Dokumentasi</p>
                        <p class="font-medium text-gray-800">
                            {{ $dokumentasi->sumber_dokumentasi }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Keterangan</p>
                        <p class="whitespace-pre-line text-gray-800">
                            {{ $dokumentasi->keterangan ?: '-' }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('dokumentasi.index') }}"
                       class="rounded-lg border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Kembali
                    </a>

                    <a href="{{ route('dokumentasi.edit', $dokumentasi->id) }}"
                       style="background-color: #2563eb; color: white;"
                       class="rounded-lg px-5 py-3 text-sm font-semibold shadow-sm hover:opacity-90">
                        Edit Dokumentasi
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
