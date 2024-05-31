<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('category_id');
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->string('motivo');
            $table->string('tipo_movimiento');
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('producto_id')
                ->references('id')
                ->on('products') // Make sure 'productos' is the correct table name
                ->onDelete('restrict');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventarios');
    }
};
