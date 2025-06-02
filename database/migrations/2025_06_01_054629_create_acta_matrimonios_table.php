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
        Schema::create('acta_matrimonios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('novio_id')->constrained('personas')->onDelete('cascade');
            $table->foreignId('novia_id')->constrained('personas')->onDelete('cascade');
            $table->date('fecha_matrimonio');
            $table->foreignId('testigo1_id')->constrained('personas')->onDelete('cascade');
            $table->foreignId('testigo2_id')->constrained('personas')->onDelete('cascade');
            $table->foreignId('acta_id')->unique()->constrained('actas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acta_matrimonios');
    }
};
