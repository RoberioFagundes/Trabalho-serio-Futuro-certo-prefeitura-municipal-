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
        Schema::table('atendimentos', function (Blueprint $table) {
            //
            // 1. Remover FK antiga
            $table->dropForeign(['fila_id']);

            // 2. Tornar a coluna nullable
            $table->unsignedBigInteger('fila_id')->nullable()->change();

            // 3. Criar nova FK com ON DELETE SET NULL
            $table->foreign('fila_id')
                ->references('id')
                ->on('filas')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('atendimentos', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('fila_id');
        });
    }
};
