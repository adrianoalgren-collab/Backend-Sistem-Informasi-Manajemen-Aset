<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraan_history', function (Blueprint $table) {

            /*
            =========================================
            Primary Key
            =========================================
            */
            $table->id();

            /*
            =========================================
            Relasi Kendaraan
            =========================================
            */
            $table->foreignId('id_kendaraan')
                  ->nullable()                              // ← nullable agar history tetap ada
                  ->default(null)
                  ->constrained('aset_kendaraan', 'id_kendaraan')
                  ->nullOnDelete();                         // ← kendaraan dihapus → id_kendaraan jadi null, history tetap ada

            /*
            =========================================
            Relasi Driver / User
            =========================================
            */
            $table->foreignId('user_id')
                  ->nullable()                              // ← nullable agar history tetap ada
                  ->default(null)
                  ->constrained('users', 'id')
                  ->nullOnDelete();                         // ← user dihapus → user_id jadi null, history tetap ada

            /*
            =========================================
            Periode Penugasan
            =========================================
            */
            $table->timestamp('tanggal_assign')
                  ->useCurrent();                           // ← otomatis diisi saat record dibuat

            $table->timestamp('tanggal_selesai')
                  ->nullable()
                  ->default(null);                         // ← null = penugasan masih aktif

            /*
            =========================================
            Soft Delete + Timestamps
            =========================================
            */
            $table->softDeletes();                         // ← history tidak pernah benar-benar terhapus
            $table->timestamps();

            /*
            =========================================
            Index untuk Query Performance
            =========================================
            */
            $table->index('id_kendaraan');                 // ← sering di-query by kendaraan
            $table->index('user_id');                      // ← sering di-query by driver
            $table->index('tanggal_assign');               // ← sering di-filter by tanggal
            $table->index('tanggal_selesai');              // ← untuk query penugasan aktif (WHERE tanggal_selesai IS NULL)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraan_history');
    }
};