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
        Schema::create('acta_nacimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_nacido', 20);
            $table->string('apellido_nacido', 45);
            $table->enum('sexo', ['M', 'F']);
            $table->date('fecha_nacimiento');
            $table->foreignId('madre_id')->constrained('personas')->onDelete('cascade');
            $table->foreignId('padre_id')->constrained('personas')->onDelete('cascade');
            $table->foreignId('acta_id')->nullable()->constrained('actas')->onDelete('cascade');
            $table->foreignId('lugar_id')->constrained('lugar')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acta_nacimientos');
    }
};
