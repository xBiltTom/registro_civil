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
        Schema::create('actas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_registro');
            $table->foreignId('persona_id')->constrained('personas')->onDelete('cascade');;
            $table->foreignId('folio_id')->unique()->constrained('folios')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('ruta_pdf', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actas');
    }
};
