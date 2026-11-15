
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPAMBA') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#E9EDF2]">

<div x-data="{ sidebarOpen: false }" class="min-h-screen">

    <!-- Overlay Mobile -->
    <div x-show="sidebarOpen"
         x-transition.opacity
         @click="sidebarOpen = false"
         class="fixed inset-0 z-40 bg-black/50 md:hidden"
         style="display: none;">
    </div>

    <!-- SIDEBAR -->
    <aside
        class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col bg-[#171B3A] text-white shadow-xl transition-transform duration-300 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

        <!-- Logo -->
        <div class="flex h-24 items-center justify-between border-b border-white/10 px-5">
            <a href="{{ route('dashboard') }}"
            class="flex w-full items-center justify-center">

                <img
                    src="{{ asset('images/SIPAMBA Monitoring Dashboard Logo.png') }}"
                    alt="Logo SIPAMBA"
                    class="h-20 w-full object-contain"
                >

            </a>

            <button @click="sidebarOpen = false"
                    class="ml-2 text-gray-300 hover:text-white md:hidden">
                ✕
            </button>
        </div>

        <!-- Menu -->
        <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">

            <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-widest text-indigo-300">
                Menu Utama
            </p>

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="group flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-all duration-300 ease-out hover:translate-x-1 hover:bg-indigo-500/20 hover:shadow-lg
               {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/30' : 'text-gray-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="22" height="22" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="9" rx="1"/>
                    <rect x="14" y="3" width="7" height="5" rx="1"/>
                    <rect x="14" y="12" width="7" height="9" rx="1"/>
                    <rect x="3" y="16" width="7" height="5" rx="1"/>
                </svg>
                Dashboard
            </a>

            <!-- Data Pembangunan -->
            <a href="{{ route('pembangunan.index') }}"
               class="group flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-all duration-300 ease-out hover:translate-x-1 hover:bg-indigo-500/20 hover:shadow-lg
               {{ request()->routeIs('pembangunan.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/30' : 'text-gray-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="22" height="22" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M3 21h18"/>
                    <path d="M5 21V7l8-4v18"/>
                    <path d="M19 21V11l-6-4"/>
                    <path d="M9 9v.01M9 12v.01M9 15v.01M9 18v.01"/>
                    <path d="M16 13v.01M16 16v.01M16 19v.01"/>
                </svg>
                Data Pembangunan
            </a>

            <!-- Laporan Monitoring -->
            <a href="{{ route('laporan-monitoring.index') }}"
               class="group flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-all duration-300 ease-out hover:translate-x-1 hover:bg-indigo-500/20 hover:shadow-lg
               {{ request()->routeIs('laporan-monitoring.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/30' : 'text-gray-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="22" height="22" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="4" y="4" width="16" height="18" rx="2"/>
                    <path d="M9 4.5h6a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1Z"/>
                    <path d="M8 10h8"/>
                    <path d="M8 14h8"/>
                    <path d="M8 18h5"/>
                </svg>
                Laporan Monitoring
            </a>

            <!-- Dokumentasi -->
            <a href="{{ route('dokumentasi.index') }}"
               class="group flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition-all duration-300 ease-out hover:translate-x-1 hover:bg-indigo-500/20 hover:shadow-lg
               {{ request()->routeIs('dokumentasi.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/30' : 'text-gray-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="22" height="22" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <path d="m21 15-5-5L5 21"/>
                </svg>
                Dokumentasi
            </a>

            <a href="{{ route('riwayat-tindak-lanjut.index') }}"
                class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition hover:bg-white/10
                {{ request()->routeIs('riwayat-tindak-lanjut.*') ? 'bg-white/10 text-white' : 'text-gray-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="22" height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M3 12a9 9 0 1 0 3-6.7L3 8"/>
                    <path d="M3 3v5h5"/>
                    <path d="M12 7v5l4 2"/>
                </svg>
                    <span>Riwayat Pengawasan</span>
            </a>

            <div class="my-6 border-t border-white/10"></div>

            <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-widest text-indigo-300">
                Pengaturan
            </p>

            <!-- Profil -->
            <a href="{{ route('profile.edit') }}"
               class="group flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-gray-300 transition-all duration-300 hover:translate-x-1 hover:bg-indigo-500/20 hover:text-white">
                <span class="text-lg transition-transform duration-300 group-hover:scale-125">⚙</span>
                Profil Pengguna
            </a>

        </nav>

        <!-- Footer Sidebar -->
        <div class="border-t border-white/10 p-4">
            <p class="text-xs text-gray-400">SIPAMBA</p>
            <p class="mt-1 text-[10px] text-gray-500">
                Sistem Informasi Pengawasan dan Monitoring Pembangunan
            </p>
        </div>
    </aside>

    <!-- AREA KONTEN -->
    <div class="min-h-screen bg-[#E9EDF2] transition-all duration-300 md:ml-64">

        <!-- TOPBAR -->
        <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-gray-200 bg-white px-5 shadow-sm">

            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true"
                        class="rounded-lg p-2 text-gray-600 transition hover:bg-gray-100 md:hidden">
                    ☰
                </button>

                <div>
                    <p class="text-sm font-semibold text-gray-800">
                        Sistem Monitoring Pembangunan
                    </p>
                    <p class="text-xs text-gray-500">
                        DPRD Provinsi Riau - Komisi IV
                    </p>
                </div>
            </div>

            <!-- User Menu -->
            <div class="flex items-center gap-3">
                <div class="hidden text-right sm:block">
                    <p class="text-sm font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-gray-500">
                        Administrator
                    </p>
                </div>

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-600 font-bold text-white">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="rounded-lg px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50">
                        Keluar
                    </button>
                </form>
            </div>
        </header>

        <!-- JUDUL HALAMAN -->
        @isset($header)
            <div class="border-b border-gray-200 bg-white px-6 py-5">
                {{ $header }}
            </div>
        @endisset

        <!-- ISI HALAMAN -->
        <main class="p-4 sm:p-6">
            {{ $slot }}
        </main>

    </div>
</div>

</body>
</html>
