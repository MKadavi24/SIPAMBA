
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_monitorings', function (Blueprint $table) {
            $table->id();

            // Menghubungkan laporan dengan data pembangunan
            $table->foreignId('pembangunan_id')
                  ->constrained('pembangunans')
                  ->cascadeOnDelete();

            // Informasi laporan
            $table->date('tanggal_laporan');
            $table->string('periode_laporan')->nullable();

            // Sumber dan dokumen informasi
            $table->string('sumber_informasi');
            $table->string('nomor_dokumen')->nullable();

            // Isi laporan monitoring
            $table->text('ringkasan');

            // Progres hanya jika tercantum dalam sumber resmi
            $table->decimal('progres_dilaporkan', 5, 2)->nullable();

            // Catatan tindak lanjut
            $table->text('catatan_tindak_lanjut')->nullable();

            $table->enum('status_tindak_lanjut', [
                'belum_ditindaklanjuti',
                'dalam_proses',
                'selesai'
            ])->default('belum_ditindaklanjuti');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_monitorings');
    }
};
