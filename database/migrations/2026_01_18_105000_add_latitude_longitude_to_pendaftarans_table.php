<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            if (! Schema::hasColumn('pendaftarans', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->after('foto');
            }
            if (! Schema::hasColumn('pendaftarans', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftarans', 'longitude')) {
                $table->dropColumn('longitude');
            }
            if (Schema::hasColumn('pendaftarans', 'latitude')) {
                $table->dropColumn('latitude');
            }
        });
    }
};
