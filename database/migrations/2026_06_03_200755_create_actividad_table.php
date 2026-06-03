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
       
        Schema::create('actividad', function (Blueprint $table) {
            $table->id('actividad_id');
            // 1. CAMPOS ESPEJO (Exactamente como vienen en el Excel)
            $table->string('CONSIDERAR_SI_NO', 10)->nullable();
            $table->string('MODALIDAD_MODIFICADO', 50)->nullable();
            $table->integer('MODALIDAD_COD')->nullable();
            $table->string('TIPO_MODIFICADO', 100)->nullable();
            $table->integer('TIPO_ACT_COD')->nullable();
            $table->integer('CAJ_ID')->nullable();
            $table->string('SUB_TIPO_MODIFICADO', 150)->nullable();
            $table->integer('SUB_TIPO_COD')->nullable();
            $table->string('COD', 50)->nullable(); // Ej: "CJ26011"
            $table->date('FECHA')->nullable();
            $table->date('FECHA_SAJ')->nullable();
            $table->string('MODALIDAD', 50)->nullable();
            $table->string('TIPO_ACTIVIDAD', 150)->nullable();
            $table->string('SUB_TIPO_ACTIVIDAD', 150)->nullable();
            $table->integer('PARTICIPANTES')->default(0);
            $table->integer('TOTAL_HOMBRES')->default(0);
            $table->integer('TOTAL_MUJERES')->default(0);
            $table->integer('TOTAL_NOBINARIO')->default(0);
            $table->string('FUNCIONARIO', 150)->nullable(); // Nombre del funcionario en el Excel
            $table->string('UNIDAD', 150)->nullable();      // Nombre de la unidad en el Excel (Ej: "CAJ ALTO BIO BIO")
            $table->string('TIPO_UNIDAD', 50)->nullable();  // Ej: "CJ", "NAD"
            $table->integer('REGION')->nullable();          // Ej: 9, 8, 11
            $table->integer('MES')->nullable();
            $table->integer('AÑO')->nullable();
            $table->text('DET_ACTIVIDAD')->nullable();

            // 2. NUESTROS CAMPOS DE CONTROL (Metadatos internos)
            $table->string('estado', 30)->default('CARGADA'); // CARGADA, NOTIFICADA, PENDIENTE_VERIFICADOR, VERIFICADA
            $table->unsignedBigInteger('carga_id')->nullable(); // Para agrupar actividades de un mismo Excel
            $table->unsignedBigInteger('usuario_id_asignado')->nullable(); // Funcionario interno que resolverá
            $table->unsignedBigInteger('unidad_id_asignada')->nullable();   // Unidad interna a la que pertenece
            
            $table->boolean('activo')->default(true); // Para el Modo Edición o bajas lógicas
            $table->timestamps();

            // Llaves foráneas a nuestro modelo de dominio
            $table->foreign('usuario_id_asignado')->references('usuario_id')->on('usuario');
            $table->foreign('unidad_id_asignada')->references('unidad_id')->on('unidad');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actividad', function (Blueprint $table) {
            $table->dropForeign(['usuario_id_asignado']);
            $table->dropForeign(['unidad_id_asignada']);
        });

        Schema::dropIfExists('actividad');
    }
};
