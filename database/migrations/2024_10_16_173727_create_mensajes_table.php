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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->binary('mensaje'); // BLOB para el mensaje encriptado
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps(); // Opcional para saber cuándo se creó o modificó
        });
    }  

    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }

};
