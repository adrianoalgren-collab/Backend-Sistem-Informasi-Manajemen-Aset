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
        Schema::create('request_pemakaian', function (Blueprint $table) {

            /*
            =========================================
            Primary Key
            =========================================
            */
            $table->id('id_request_pemakaian');

            /*
            =========================================
            Kode Request Pemakaian
            =========================================
            */
            $table->string('kode_request_pemakaian', 50)
                  ->unique();

            /*
            =========================================
            Tanggal Pengajuan
            =========================================
            */
            $table->date('tanggal_request');

            /*
            =========================================
            Relasi Aset Barang Pakai
            =========================================
            */
            $table->foreignId('id_barang_pakai')
                  ->constrained('aset_barang_pakai', 'id_barang_pakai')
                  ->cascadeOnDelete();

            /*
            =========================================
            Jumlah Pemakaian
            =========================================
            */
            $table->integer('jumlah_pemakaian');

            /*
            =========================================
            Keterangan Pemakaian
            =========================================
            */
            $table->text('keterangan_pemakaian');

            /*
            =========================================
            Relasi Department
            =========================================
            */
            $table->foreignId('id_department')
                  ->constrained('department', 'id_department')
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
            File Request Pemakaian
            =========================================
            */
            $table->string('file_request');

            /*
            =========================================
            Status Approval Manager
            =========================================
            */
            $table->string('status_approval')->default('Pending');

            /*
            =========================================
            Catatan Manager
            =========================================
            */
            $table->text('catatan_manager')
                  ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_pemakaian');
    }
};