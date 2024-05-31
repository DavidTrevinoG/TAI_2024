<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('cliente_id');
            $table->integer('cantidad');
            $table->date('fecha_venta');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('iva', 8, 2);
            $table->decimal('total', 8, 2);
            $table->timestamps();
            $table->foreign('producto_id')
                ->references('id')
                ->on('products') // Make sure 'productos' is the correct table name
                ->onDelete('restrict');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict');
            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
