<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('request_perbaikan', function (Blueprint $table) {

            /*
            =========================================
            Primary Key
            =========================================
            */
            $table->id('id_request_perbaikan');

            /*
            =========================================
            Relasi Aset Operasional
            =========================================
            */
            $table->foreignId('id_operasional')
                  ->constrained('aset_operasional', 'id_operasional')
                  ->cascadeOnDelete();

            /*
            =========================================
            Relasi Kode Barang  ← TAMBAHAN BARU
            =========================================
            */
            $table->foreignId('id_kodebarang')
                  ->constrained('kode_barang', 'id_kodebarang')
                  ->cascadeOnDelete();

            /*
            =========================================
            Relasi User (Staff Pengaju)
            =========================================
            */
            $table->foreignId('id_user')
                  ->constrained('users', 'id')
                  ->cascadeOnDelete();

            /*
            =========================================
            Tanggal Request
            =========================================
            */
            $table->timestamp('tanggal_request')
                  ->useCurrent();

            /*
            =========================================
            File Request Perbaikan
            =========================================
            */
            $table->string('file_request', 500);

            /*
            =========================================
            Status Request  ← FIX KAPITAL
            =========================================
            */
            $table->string('status_request')->default('Pending');

            /*
            =========================================
            Catatan Admin
            =========================================
            */
            $table->text('catatan_admin')
                  ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_perbaikan');
    }
};