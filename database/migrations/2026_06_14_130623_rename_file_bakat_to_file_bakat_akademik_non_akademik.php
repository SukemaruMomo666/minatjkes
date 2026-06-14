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
            $table->renameColumn('file_bakat', 'file_bakat_akademik');
            $table->string('file_bakat_non_akademik')->nullable()->after('file_bakat_akademik');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('file_bakat_non_akademik');
            $table->renameColumn('file_bakat_akademik', 'file_bakat');
        });
    }
};
