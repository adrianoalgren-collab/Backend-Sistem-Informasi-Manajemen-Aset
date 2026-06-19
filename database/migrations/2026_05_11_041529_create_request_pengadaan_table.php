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
        Schema::create('request_pengadaan', function (Blueprint $table) {

            /*
            =========================================
            Primary Key
            =========================================
            */
            $table->id('id_request_pengadaan');

            /*
            =========================================
            Kode Request Pengadaan
            =========================================
            */
            $table->string('kode_request_pengadaan', 50)
                  ->unique();

            /*
            =========================================
            Tanggal Pengajuan
            =========================================
            */
            $table->date('tanggal_request');

            /*
            =========================================
            Nama Pengadaan
            =========================================
            */
            $table->string('nama_pengadaan');

            /*
            =========================================
            Kategori Pengadaan
            =========================================
            */
            $table->string('kategori_pengadaan');

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
            File Request Pengadaan
            =========================================
            */
            $table->string('file_request')
                  ->nullable();

            /*
            =========================================
            Status Approval Manager
            =========================================
            */
            $table->enum('status_approval', [
                'Pending',
                'Approved',
                'Rejected'
            ])->default('Pending');

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
        Schema::dropIfExists('request_pengadaan');
    }
};