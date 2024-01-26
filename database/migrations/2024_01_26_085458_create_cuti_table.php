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
            $table->string('jenis_cuti');
            $table->string('alasan_cuti');
            $table->date('tanggal_mulai');
            $table->integer('lamanya_cuti');
            $table->date('tanggal_pengajuan')->default(now());
            $table->date('tanggal_selesai');
            $table->unsignedBigInteger('karyawan_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('karyawan_id')->references('id')->on('karyawan');
            $table->foreign('status_id')->references('id')->on('status_pengajuan');
        });
    }

//     nip
// jenis cuti (dropdown)
// alasan cuti
// tanggal mulai cuti
// lamanya cuti
// status pengajuan
// tanggal pengajuan
// tanggal diterima

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
