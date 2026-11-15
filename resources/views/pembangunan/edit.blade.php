<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Edit Data Pembangunan
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            <div class="rounded-xl bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">
                        Perbarui Informasi Pembangunan
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Pastikan perubahan sesuai dengan sumber informasi.
                    </p>
                </div>

                <form action="{{ route('pembangunan.update', $pembangunan->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    @include('pembangunan._form')

                    <div class="mt-8 flex flex-wrap justify-end gap-3">
                        <a href="{{ route('pembangunan.index') }}"
                           class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>

                        <button type="submit"
                                class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-800">
                            Perbarui Data
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>