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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8)->unique();
            $table->string('nombre', 45);
            $table->string('apellido', 45);
            $table->foreignId('lugar_id')->constrained('lugar')->onDelete('cascade');
            $table->enum('sexo', ['M', 'F']);
            $table->date('fecha_nacimiento');
            $table->char('estado_civil', 1)->default('S');
            $table->string('telefono', 9);
            $table->boolean('pertenece_pueblo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
