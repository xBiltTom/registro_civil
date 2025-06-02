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
        Schema::create('acta_nacimiento_persona', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->onDelete('cascade');
            $table->foreignId('acta_nacimiento_id')->constrained('acta_nacimientos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acta_nacimiento_persona');
    }
};
