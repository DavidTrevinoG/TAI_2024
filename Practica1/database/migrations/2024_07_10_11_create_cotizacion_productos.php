<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cotizacion_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cotizaciones');
            $table->unsignedBigInteger('id_productos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('Cotizaciones');
    }
};
