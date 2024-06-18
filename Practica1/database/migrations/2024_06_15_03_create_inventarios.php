<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Inventarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_productos');
            $table->date('fecha_salida');
            $table->date('fecha_entrada');
            $table->string('movimiento');
            $table->string('motivo');
            $table->integer('cantidad');
            $table->foreign('id_productos')
                ->references('id')
                ->on('products')
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Inventarios');
    }
};
