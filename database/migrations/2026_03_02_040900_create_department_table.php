<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('department', function (Blueprint $table) {

            $table->id('id_department');

            $table->string('kode_department', 20)->unique();

            $table->string('nama_department', 100);

            $table->string('penanggungjawab_department', 100);

            $table->string('email_department', 100)->nullable();

            $table->string('nomor_telepon_department', 20)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('department');
    }
};