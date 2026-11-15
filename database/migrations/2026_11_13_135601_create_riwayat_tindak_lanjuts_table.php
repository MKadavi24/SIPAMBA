
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_tindak_lanjuts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laporan_monitoring_id')
                ->constrained('laporan_monitorings')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->date('tanggal_tindak_lanjut');

            $table->enum('status', [
                'belum_ditindaklanjuti',
                'dalam_proses',
                'selesai'
            ]);

            $table->text('catatan');

            $table->string('sumber_informasi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_tindak_lanjuts');
    }
};
