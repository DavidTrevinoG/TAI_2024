<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('correo');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('rfc');
            $table->string('razon_social');
            $table->string('codigo_postal');
            $table->string('regimen_fiscal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Clientes');
    }
};
