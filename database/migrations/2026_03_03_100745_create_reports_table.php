<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id('id_report');

            $table->string('judul', 255);
            $table->date('tanggal');
            $table->string('status')->default('pending');  
            $table->string('file_path', 500)->nullable(); // cukup panjang untuk full path/URL

            // Foreign key ke users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict'); // cegah hapus user yang masih punya report

            // Index untuk performa query
            $table->index('user_id');
            $table->index('status');
            $table->index('tanggal');

            $table->softDeletes(); // proteksi data dari hard delete
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};