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
        Schema::table('users', function (Blueprint $table) {
            // Cek dulu biar tidak error kalau kolom sudah ada
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable()->after('email'); // Kolom No WA
            }
            
            if (!Schema::hasColumn('users', 'guardian_phone')) {
                $table->string('guardian_phone', 20)->nullable()->after('phone'); // Kolom No Wali
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'guardian_phone']);
        });
    }
};