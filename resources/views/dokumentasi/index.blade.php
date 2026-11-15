<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dokumentasi Pembangunan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">
                        Data Dokumentasi
                    </h3>
                    <p class="text-sm text-gray-500">
                        Kumpulan foto dan catatan dokumentasi pembangunan.
                    </p>
                </div>

                <a href="{{ route('dokumentasi.create') }}"
                   style="background-color: #2563eb; color: white;"
                   class="rounded-lg px-5 py-3 text-sm font-semibold shadow-sm hover:opacity-90">
                    + Tambah Dokumentasi
                </a>
            </div>

            <div class="overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">No.</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Foto</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Judul</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Pembangunan</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Tanggal</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Sumber</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-gray-600">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($dokumentasis as $index => $item)
                                <tr>
                                    <td class="px-5 py-4 text-sm text-gray-700">
                                        {{ $dokumentasis->firstItem() + $index }}
                                    </td>

                                    <td class="px-5 py-4">
                                        <img src="{{ asset('storage/' . $item->file_path) }}"
                                             alt="{{ $item->judul }}"
                                             class="h-16 w-24 rounded-lg object-cover">
                                    </td>

                                    <td class="px-5 py-4 text-sm font-medium text-gray-800">
                                        {{ $item->judul }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-gray-700">
                                        {{ $item->pembangunan?->nama_pembangunan ?? 'Data tidak tersedia' }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-gray-700">
                                        {{ $item->tanggal_dokumentasi->format('d-m-Y') }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-gray-700">
                                        {{ $item->sumber_dokumentasi }}
                                    </td>

                                    <td class="px-5 py-4 text-sm">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('dokumentasi.show', $item->id) }}"
                                               class="font-medium text-blue-600 hover:underline">
                                                Detail
                                            </a>

                                            <a href="{{ route('dokumentasi.edit', $item->id) }}"
                                               class="font-medium text-yellow-600 hover:underline">
                                                Edit
                                            </a>

                                            <form action="{{ route('dokumentasi.destroy', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus dokumentasi ini?')">
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
                                        Belum ada dokumentasi pembangunan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-5 py-4">
                    {{ $dokumentasis->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
