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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('incidencia_id');
            $table->string('description');
            $table->enum('estate', ['Pendiente', 'En proceso', 'Solucionada', 'No solucionada']);
            $table->float('price');
            $table->enum('cost_responsible', ['Cliente', 'Propietario', 'Homeselect']);
            $table->string('comentario');
            $table->foreign('incidencia_id')->references('id')->on('incidents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
