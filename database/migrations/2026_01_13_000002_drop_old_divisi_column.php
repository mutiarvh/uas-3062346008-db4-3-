<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tidak jadi menghapus kolom lama `divisi_yang_diinginkan`,
        // karena kolom inilah yang sekarang digunakan aplikasi.
    }

    public function down(): void
    {
        //
    }
};
