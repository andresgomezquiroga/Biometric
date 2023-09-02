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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id('Id_timeTable');
            $table->enum('Jornada',['Manana','Tarde','Mixta']);
            $table->date('Fecha_inicio');
            $table->date('Fecha_finalizacion');
            $table->time('time_start');
            $table->time('time_finish');
            $table->unsignedBigInteger('ficha_id')->nullable();
            $table->foreign('ficha_id')->references('id_ficha')->on('fichas');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
