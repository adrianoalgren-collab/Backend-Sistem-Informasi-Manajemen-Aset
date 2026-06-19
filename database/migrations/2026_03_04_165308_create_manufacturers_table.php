<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('manufacturers', function (Blueprint $table) {

            $table->id('id_manufacturer');

            $table->string('nama_manufacturer')->unique();

            $table->string('email_manufacturer')
                  ->nullable()
                  ->unique();

            $table->string('telfon_manufacturer')
                  ->nullable();

            $table->text('alamat_manufacturer')
                  ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manufacturers');
    }
};