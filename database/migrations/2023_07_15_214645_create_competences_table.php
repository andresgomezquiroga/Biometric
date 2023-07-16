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
        Schema::create('competences', function (Blueprint $table) {
            $table->id('id_competence');
            $table->string('name_competence');
            $table->string('description_competence');
            $table->unsignedInteger('ficha_id')->nullable();
            $table->foreign('ficha_id')->references('id')->on('fichas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competences');
    }
};
