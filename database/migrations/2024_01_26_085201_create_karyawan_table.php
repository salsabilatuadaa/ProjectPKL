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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama');
            // $table->string('jabatan');
            $table->string('lokasi_kerja');
            // $table->string('foto_profil');
            $table->integer('saldo_cuti')->default(12);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('atasan_id');

            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('atasan_id')->references('id')->on('atasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
