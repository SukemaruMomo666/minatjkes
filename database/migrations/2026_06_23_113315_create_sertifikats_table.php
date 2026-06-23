<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('jenis', ['akademik', 'non_akademik']);
            $table->string('nama_sertifikat')->nullable();
            $table->string('file_path');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        // Migrasi data lama dari kolom users ke tabel baru
        if (Schema::hasColumn('users', 'file_bakat_akademik')) {
            $rows = DB::table('users')
                ->whereNotNull('file_bakat_akademik')
                ->select('id', 'file_bakat_akademik')
                ->get();

            foreach ($rows as $row) {
                DB::table('sertifikats')->insert([
                    'user_id' => $row->id,
                    'jenis' => 'akademik',
                    'nama_sertifikat' => 'Sertifikat Akademik',
                    'file_path' => $row->file_bakat_akademik,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        if (Schema::hasColumn('users', 'file_bakat_non_akademik')) {
            $rows = DB::table('users')
                ->whereNotNull('file_bakat_non_akademik')
                ->select('id', 'file_bakat_non_akademik')
                ->get();

            foreach ($rows as $row) {
                DB::table('sertifikats')->insert([
                    'user_id' => $row->id,
                    'jenis' => 'non_akademik',
                    'nama_sertifikat' => 'Sertifikat Non-Akademik',
                    'file_path' => $row->file_bakat_non_akademik,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
