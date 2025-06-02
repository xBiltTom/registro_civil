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
        Schema::create('acta_defunciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fallecido_id')->constrained('personas')->onDelete('cascade');
            $table->date('fecha_defuncion');
            $table->foreignId('declarante_id')->constrained('personas')->onDelete('cascade');
            $table->foreignId('acta_id')->unique()->constrained('actas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acta_defunciones');
    }
};
