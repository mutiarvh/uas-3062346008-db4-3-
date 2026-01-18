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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan');
            $table->string('tempat_tanggal_lahir');
            $table->string('alamat_asal');
            $table->string('alamat_di_malang');
            $table->string('email')->unique();
            $table->string('motivasi');
            $table->string('pengalaman_berorganisasi');
            $table->string('pengalaman_kepanitiaan');
            $table->string('motto_hidup');
            $table->json('divisi_yang_diinginkan')->nullable();
            $table->string('foto')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
