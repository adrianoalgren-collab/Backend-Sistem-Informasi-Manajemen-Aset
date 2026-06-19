<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aset_operasional', function (Blueprint $table) {

            $table->id('id_operasional');

            /*
            =========================================
            DATA UMUM ASET
            =========================================
            contoh:
            - Laptop Dell
            - Printer Epson
            - AC Panasonic
            =========================================
            */

            $table->string('nama_asetoperasional');

            /*
            =========================================
            FOTO MASTER ASET
            =========================================
            foto umum aset, bukan per unit
            =========================================
            */

            $table->string('foto_asetoperasional')
                ->nullable();

            /*
            =========================================
            RELASI MANUFACTURER
            =========================================
            */

            $table->foreignId('id_manufacturer')
                ->nullable()
                ->constrained('manufacturers', 'id_manufacturer')
                ->nullOnDelete();

            $table->timestamps();
        });

        /*
        =========================================
        TABLE KODE BARANG
        =========================================
        menyimpan detail tiap unit barang

        contoh:
        Laptop Dell:
        - OFF001
        - OFF002
        - OFF003

        di sini kondisi + lokasi per unit disimpan
        =========================================
        */

        Schema::create('kode_barang', function (Blueprint $table) {

            $table->id('id_kodebarang');

            $table->foreignId('id_operasional')
                ->constrained('aset_operasional', 'id_operasional')
                ->onDelete('cascade');

            $table->string('kode_barang', 50)
                ->unique();

            $table->enum('kondisi_asetoperasional', [
                'Baik',
                'Rusak Ringan',
                'Rusak Berat'
            ]);

            $table->string('lokasi_asetoperasional');

            /*
            =========================================
            FOTO PER UNIT (tetap ada)
            =========================================
            */

            $table->string('foto_asetoperasional')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_barang');
        Schema::dropIfExists('aset_operasional');
    }
};