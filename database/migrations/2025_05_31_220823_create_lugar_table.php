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
        Schema::create('lugar', function (Blueprint $table) {
            $table->id();
            $table->string('distrito', 45)->default('Chicama');
            $table->string('provincia', 45)->default('Ascope');
            $table->string('departamento', 45)->default('La Libertad');
            $table->string('pais', 45)->default('Perú');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lugar');
    }
};
