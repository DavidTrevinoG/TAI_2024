<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_clientes');
            $table->unsignedBigInteger('id_vendedores');
            $table->unsignedBigInteger('id_formapago');
            $table->unsignedBigInteger('id_productos');
            $table->date('fecha_venta');
            $table->decimal('cambio', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('iva', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
            $table->foreign('id_clientes')
                ->references('id')
                ->on('Clientes')
                ->onDelete('restrict');
            $table->foreign('id_vendedores')
                ->references('id')
                ->on('Vendedores')
                ->onDelete('restrict');
            $table->foreign('id_formapago')
                ->references('id')
                ->on('forma_pagos')
                ->onDelete('restrict');
            $table->foreign('id_productos')
                ->references('id')
                ->on('products')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Ventas');
    }
};
