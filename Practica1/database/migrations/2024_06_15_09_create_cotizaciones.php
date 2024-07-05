<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_clientes');
            $table->unsignedBigInteger('id_productos');
            $table->date('vigencia');
            $table->integer('cantidad');
            $table->integer('comentarios');
            $table->foreign('id_clientes')
                ->references('id')
                ->on('Clientes')
                ->onDelete('restrict');
            $table->foreign('id_productos')
                ->references('id')
                ->on('products')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Cotizaciones');
    }
};
