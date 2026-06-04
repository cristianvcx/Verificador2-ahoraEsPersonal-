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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('usuario_id');
            $table->unsignedBigInteger('unidad_id')->nullable();
            $table->string('usuario_nombre', 30)->nullable();
            $table->string('usuario_pass', 35)->nullable();

            $table->foreign('unidad_id')
                ->references('unidad_id')
                ->on('unidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
