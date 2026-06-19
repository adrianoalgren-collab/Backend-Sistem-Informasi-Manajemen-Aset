<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aset_kendaraan', function (Blueprint $table) {

            /*
            =========================================
            Primary Key
            =========================================
            */
            $table->id('id_kendaraan');

            /*
            =========================================
            Kode Kendaraan
            =========================================
            */
            $table->string('kode_kendaraan', 50)
                  ->unique();

            /*
            =========================================
            Nama Kendaraan
            =========================================
            */
            $table->string('nama_kendaraan', 100);

            /*
            =========================================
            Relasi Manufacturer
            =========================================
            */
            $table->foreignId('id_manufacturer')
                  ->constrained('manufacturers', 'id_manufacturer')
                  ->restrictOnDelete(); // ← cascade diganti restrict: manufacturer tidak boleh dihapus jika masih ada kendaraan

            /*
            =========================================
            Plat Kendaraan
            =========================================
            */
            $table->string('plat_kendaraan', 20)
                  ->unique();

            /*
            =========================================
            Kondisi Kendaraan
            =========================================
            */
            $table->enum('kondisi_kendaraan', [
                'baik',
                'rusak_ringan',
                'rusak_berat',
                'tidak_aktif',
            ])->default('baik'); // ← enum + default untuk data integrity

            /*
            =========================================
            Relasi User / Driver
            =========================================
            */
            $table->foreignId('id_user')
                  ->nullable()
                  ->default(null)
                  ->constrained('users', 'id')
                  ->nullOnDelete();

            /*
            =========================================
            Soft Delete + Timestamps
            =========================================
            */
            $table->softDeletes(); // ← untuk production: hapus data tidak permanen
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aset_kendaraan');
    }
};