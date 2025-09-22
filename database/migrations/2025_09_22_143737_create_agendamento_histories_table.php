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
            $table->foreignId('agendamento_id')->constrained()->cascadeOnDelete();
            $table->date('nova_data');
            $table->time('nova_hora');
            $table->string('motivo')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamento_histories');
    }
};
