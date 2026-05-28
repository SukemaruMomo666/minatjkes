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
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->cascadeOnDelete(); 
            $table->enum('tipe', ['akademik', 'non_akademik', 'mbti']);
            $table->text('teks_soal');
            $table->enum('dimensi_mbti', ['EI', 'SN', 'TF', 'JP'])->nullable(); 
            $table->text('opsi_a')->nullable(); 
            $table->text('opsi_b')->nullable(); 
            $table->tinyInteger('bobot')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
