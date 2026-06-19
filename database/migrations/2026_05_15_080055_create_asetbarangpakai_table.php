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
        Schema::create('aset_barang_pakai', function (Blueprint $table) {

            $table->id('id_barang_pakai');

            // Kode unik barang
            $table->string('kode_asetbarangpakai', 50)->unique();

            // Nama barang
            $table->string('nama_asetbarangpakai');

            // Kategori barang
            $table->string('kategori_asetbarangpakai');

            // Kondisi barang
            $table->enum('kondisi_asetbarangpakai', [
                'Baik',
                'Rusak Ringan',
                'Rusak Berat',
                'Dalam Perbaikan',
                'Tidak Digunakan'
            ]);

            // Lokasi penyimpanan
            $table->string('lokasi_asetbarangpakai');

            // Jumlah stok
            $table->integer('stok_asetbarangpakai')->default(1);

            // Satuan
            $table->string('satuan_asetbarangpakai')->default('pcs');

            // Foto barang
            $table->string('foto_asetbarangpakai')->nullable();

            // Relasi ke manufacturer / vendor
            $table->foreignId('id_manufacturer')
                ->nullable()
                ->constrained('manufacturers', 'id_manufacturer')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_barang_pakai');
    }
};