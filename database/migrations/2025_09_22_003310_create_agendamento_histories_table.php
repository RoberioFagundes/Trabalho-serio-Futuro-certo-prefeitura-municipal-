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
        Schema::create('agendamento_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agendamento_id');
            $table->foreign('agendamento_id')->references('id')->on('agendamentos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('nova_data');
            $table->time('nova_hora');
            $table->string('motivo')->nullable();
            $table->timestamps();
        });
        //database/migrations/2025_09_22_003310_create_agendamento_histories_table.php
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamento_histories');
    }
};
