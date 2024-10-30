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
        Schema::table('pedidos', function (Blueprint $table) {
        $table->timestamp('pedido_fecha_aprob');
        $table->unsignedBigInteger("empresa_id")->nullable();
        $table->foreign("empresa_id")->references("id")->on("empresa")->onDelete('restrict')->onUpdate('cascade');
        $table->unsignedBigInteger("sucursal_id")->nullable();
        $table->foreign("sucursal_id")->references("id")->on("sucursal")->onDelete('restrict')->onUpdate('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
