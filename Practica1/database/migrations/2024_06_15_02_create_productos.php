<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('id_categorias');
            $table->string('precio_venta');
            $table->string('precio_compra');
            $table->date('fecha_compra');
            $table->string('color');
            $table->string('descripcion_corta');
            $table->string('descripcion_larga');
            $table->integer('existencia');
            $table->foreign('id_categorias')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
