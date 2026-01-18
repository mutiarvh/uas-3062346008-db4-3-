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
        Schema::table('pendaftarans', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            //
    $table->string('tempat_tanggal_lahir')->after('nama_panggilan');
    $table->string('alamat_asal')->after('tempat_tanggal_lahir');
    $table->string('alamat_di_malang')->after('alamat_asal');
    $table->string('motivasi')->after('email');
    $table->string('pengalaman_berorganisasi')->after('motivasi');
    $table->string('pengalaman_kepanitiaan')->after('pengalaman_berorganisasi');
    $table->string('motto_hidup')->after('pengalaman_kepanitiaan');
    $table->string('divisi_yang_diinginkan')->after('motto_hidup');
        });
    }
};
