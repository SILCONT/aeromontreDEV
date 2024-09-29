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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('componente_id');
            $table->foreign('componente_id')->references('id')->on('componentes');
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->unsignedBigInteger('plane_id')->nullable();
            $table->foreign('plane_id')->references('id')->on('planes');
            $table->date('caducidad')->nullable();  //fecha de caducidad
            $table->date('ingreso'); //fecha de ingreso
            $table->string('parte');  //numero de parte
            $table->string('serie');  //numero de serie
            $table->string('asignacion');  //asignación (Stock, Cliente, Matricula)
            $table->string('ubicacion');   //lugar de almacenamiento
            $table->string('codigo')->nullable();    //codigo de barras
            $table->integer('cantidad');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
