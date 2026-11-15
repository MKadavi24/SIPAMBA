<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembangunans', function (Blueprint $table) {
            $table->id();

            $table->string('nama_pembangunan');

            $table->string('kategori');

            $table->text('lokasi');

            $table->year('tahun_anggaran')->nullable();

            $table->string('instansi_pelaksana')->nullable();

            $table->text('sumber_informasi');

            $table->date('tanggal_data')->nullable();

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembangunans');
    }
};