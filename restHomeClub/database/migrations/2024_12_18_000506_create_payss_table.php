<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     *    id_pago INT AUTO_INCREMENT PRIMARY KEY,
     * 
     * 
     */
    public function up(): void
    {
        Schema::create('payss', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('reservation_id');
            $table->float('price');
            $table->date('booking_date')->nullable();
            $table->enum('cost_responsible', ['Cliente', 'Propietario', 'Homeselect']);
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payss');
    }
};
