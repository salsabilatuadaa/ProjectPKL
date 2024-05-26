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
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->string('alasan_cuti');
            $table->date('tanggal_mulai');
            $table->integer('lamanya_cuti');
            $table->date('tanggal_pengajuan')->default(now());
            $table->date('tanggal_selesai');
            $table->unsignedBigInteger('karyawan_id');
            $table->unsignedBigInteger('atasan_id');
            $table->unsignedBigInteger('status_id')->default(3);
            $table->unsignedBigInteger('status_atasan')->default(3);
            $table->unsignedBigInteger('jenis_cuti_id');
            $table->string('file_persyaratan')->nullable();
            $table->unsignedBigInteger('aktor_atasan')->nullable();
            $table->unsignedBigInteger('aktor_hr')->nullable();
            $table->timestamps();


            $table->foreign('atasan_id')->references('id')->on('atasan');
            $table->foreign('karyawan_id')->references('id')->on('karyawan');
            $table->foreign('status_id')->references('id')->on('status_pengajuan');
            $table->foreign('status_atasan')->references('id')->on('status_pengajuan');
            $table->foreign('jenis_cuti_id')->references('id')->on('jenis_cuti');
            $table->foreign('aktor_atasan')->references('id')->on('jabatan');
            $table->foreign('aktor_hr')->references('id')->on('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
