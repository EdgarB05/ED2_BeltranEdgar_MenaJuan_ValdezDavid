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
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id();
            $table -> string('nombrehuesped');
            $table -> date('fechaingreso');
            $table -> date('fechafin');
            $table -> integer('numhabitacion');
            $table -> string('metodopago');
            $table -> string('estadocontrato');
            $table -> string('servicios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservaciones');
    }
};
