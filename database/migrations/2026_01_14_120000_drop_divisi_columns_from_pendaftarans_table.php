<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftarans', 'divisi_1')) {
                $table->dropColumn('divisi_1');
            }

            if (Schema::hasColumn('pendaftarans', 'divisi_2')) {
                $table->dropColumn('divisi_2');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            if (! Schema::hasColumn('pendaftarans', 'divisi_1')) {
                $table->string('divisi_1')->nullable();
            }

            if (! Schema::hasColumn('pendaftarans', 'divisi_2')) {
                $table->string('divisi_2')->nullable();
            }
        });
    }
};
