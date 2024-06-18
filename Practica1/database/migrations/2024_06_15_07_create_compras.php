<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proveedores');
            $table->unsignedBigInteger('id_productos');
            $table->unsignedBigInteger('id_forma_pago');
            $table->date('fecha_compra');
            $table->integer('cantidad');
            $table->decimal('precio', 10, 2);
            $table->decimal('descuento', 10, 2);
            $table->decimal('total', 10, 2);
            $table->foreign('id_forma_pago')->references('id')->on('forma_pagos')->onDelete('restrict');
            $table->foreign('id_productos')->references('id')->on('products')->onDelete('restrict');
            $table->foreign('id_proveedores')->references('id')->on('Proveedores')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Compras');
    }
};
