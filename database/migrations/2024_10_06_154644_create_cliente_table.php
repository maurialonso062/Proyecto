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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('cliente_nombre', 100);
            $table->string('cliente_apellido', 100);
            $table->string('cliente_ruc', 50);
            $table->string('cliente_direc', 200);
            $table->string('cliente_telefono', 50);
            $table->string('cliente_email', 200);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
