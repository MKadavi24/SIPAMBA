
<?php

use App\Http\Controllers\PembangunanController;
use App\Http\Controllers\LaporanMonitoringController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatTindakLanjutController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Semua pengguna yang sudah login
Route::middleware(['auth'])->group(function () {

    // Dashboard: semua role
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Pengaturan profil: semua role
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // ==========================================
    // ADMIN DAN OPERATOR
    // Bisa menambah dan mengubah data
    // ==========================================

    Route::middleware(['role:admin,operator'])->group(function () {

        // Data Pembangunan
        Route::resource('pembangunan', PembangunanController::class)
            ->only(['create', 'store', 'edit', 'update']);

        // Laporan Monitoring
        Route::resource(
            'laporan-monitoring',
            LaporanMonitoringController::class
        )->parameters([
            'laporan-monitoring' => 'laporanMonitoring'
        ])->only(['create', 'store', 'edit', 'update']);

        // Dokumentasi
        Route::resource('dokumentasi', DokumentasiController::class)
            ->only(['create', 'store', 'edit', 'update']);
    });


    // ==========================================
    // ADMIN SAJA
    // Bisa menghapus data
    // ==========================================

    Route::middleware(['role:admin'])->group(function () {

        Route::delete(
            'pembangunan/{pembangunan}',
            [PembangunanController::class, 'destroy']
        )->name('pembangunan.destroy');

        Route::delete(
            'laporan-monitoring/{laporanMonitoring}',
            [LaporanMonitoringController::class, 'destroy']
        )->name('laporan-monitoring.destroy');

        Route::delete(
            'dokumentasi/{dokumentasi}',
            [DokumentasiController::class, 'destroy']
        )->name('dokumentasi.destroy');
    });


    // ==========================================
    // SEMUA ROLE
    // Hanya dapat melihat data
    // ==========================================

    Route::get('/pembangunan/export/excel', [
        PembangunanController::class,
        'exportExcel'
    ])->middleware('role:admin,operator,pengawas')
    ->name('pembangunan.export.excel');

    Route::get('/pembangunan/export/pdf', [
        PembangunanController::class,
        'exportPdf'
    ])->middleware('role:admin,operator,pengawas')
    ->name('pembangunan.export.pdf');

    Route::resource('pembangunan', PembangunanController::class)
        ->only(['index', 'show']);

    Route::get('/laporan-monitoring/export/excel', [
        LaporanMonitoringController::class,
        'exportExcel'
    ])->middleware('role:admin,operator,pengawas')
    ->name('laporan-monitoring.export.excel');

    Route::get('/laporan-monitoring/export/pdf', [
        LaporanMonitoringController::class,
        'exportPdf'
    ])->middleware('role:admin,operator,pengawas')
    ->name('laporan-monitoring.export.pdf');
    
    Route::resource(
        'laporan-monitoring',
        LaporanMonitoringController::class
    )->parameters([
        'laporan-monitoring' => 'laporanMonitoring'
    ])->only(['index', 'show']);

    Route::resource('dokumentasi', DokumentasiController::class)
        ->only(['index', 'show']);

    // Hanya admin dan operator yang dapat menambahkan riwayat
    Route::get('/riwayat-tindak-lanjut/export/pdf', [
        RiwayatTindakLanjutController::class,
        'exportPdf'
    ])->middleware('role:admin,operator,pengawas')
    ->name('riwayat-tindak-lanjut.export.pdf');

    Route::get('/riwayat-tindak-lanjut/export/excel', [
            RiwayatTindakLanjutController::class,
            'exportExcel'
        ])->middleware('role:admin,operator,pengawas')
        ->name('riwayat-tindak-lanjut.export.excel');

    Route::middleware('role:admin,operator')->group(function () {
        Route::get('/riwayat-tindak-lanjut/create',
            [RiwayatTindakLanjutController::class, 'create']
        )->name('riwayat-tindak-lanjut.create');

        Route::post('/riwayat-tindak-lanjut',
            [RiwayatTindakLanjutController::class, 'store']
        )->name('riwayat-tindak-lanjut.store');
    });

    // Riwayat tindak lanjut: semua role dapat melihat
    Route::middleware('role:admin,operator,pengawas')->group(function () {
        Route::get('/riwayat-tindak-lanjut',
            [RiwayatTindakLanjutController::class, 'index']
        )->name('riwayat-tindak-lanjut.index');

        Route::get('/riwayat-tindak-lanjut/{riwayatTindakLanjut}',
            [RiwayatTindakLanjutController::class, 'show']
        )->name('riwayat-tindak-lanjut.show');
    });

    
});

// Autentikasi Laravel Breeze
require __DIR__.'/auth.php';
