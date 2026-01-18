<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Tidak ada perubahan skema lagi untuk kolom divisi.
        // Kolom JSON yang dipakai adalah `divisi_yang_diinginkan` sesuai migrasi awal.
    }

    public function down(): void
    {
        //
    }
};
