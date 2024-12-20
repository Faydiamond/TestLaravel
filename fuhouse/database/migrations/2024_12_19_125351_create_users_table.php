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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telphone');
            $table->unsignedBigInteger('role_id');  // Este es el campo de clave foránea
            $table->unsignedBigInteger('city_id');
            $table->foreign('role_id')->references('id')->on('rols')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('citys')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
