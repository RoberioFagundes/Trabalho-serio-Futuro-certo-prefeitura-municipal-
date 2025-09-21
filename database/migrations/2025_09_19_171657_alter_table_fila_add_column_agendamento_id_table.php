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
        Schema::table('filas', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('agendamento_id')->nullable();
            $table->foreign('agendamento_id')->references('id')->on('agendamentos')
            ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('filas', function (Blueprint $table) {
            //
            $table->dropColumn('agendamento_id');
        });
    }
};
