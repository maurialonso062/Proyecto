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
        Schema::table('items', function (Blueprint $table) {
            $table->unsignedInteger("marca_id")->nullable(); 
            $table->foreign("marca_id")->
            references("id")->
            on("marca")->
            onDelete("restrict")->
            onUpdate("cascade");

            $table->unsignedBigInteger('tipo_impuesto_id')->nullable();
            $table->foreign('tipo_impuesto_id')
                ->references('id')
                ->on('tipo_impuesto')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            //
        });
    }
};
