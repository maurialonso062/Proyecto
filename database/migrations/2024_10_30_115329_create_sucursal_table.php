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
        Schema::create('sucursal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresa')->onDelete('restrict')->onUpdate('cascade');
            $table->string('suc_descri');
            $table->string('suc_direccion');
            $table->string('suc_telef');
            $table->string('suc_email');
            $table->unsignedBigInteger('ciudades_id');
            $table->foreign('ciudades_id')->references('id')->on('ciudades')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('paises_id');
            $table->foreign('paises_id')->references('id')->on('paises')->onDelete('restrict')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suc');
    }
};
