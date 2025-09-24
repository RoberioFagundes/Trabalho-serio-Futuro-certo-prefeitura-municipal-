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
            $table->string('nome')->nullable();
            $table->date('data_agendada')->nullable();
            $table->time('hora_comparecimento')->nullable();
            $table->integer('posicao_fila')->nullable();
            $table->timestamp('data_agendada')->nullable()->change();
            $table->unsignedBigInteger('agendamento_id')->nullable();
            $table->foreign('agendamento_id')
                ->references('id')
                ->on('agendamentos')
                ->cascadeOnDelete()->cascadeOnDelete()->cascadeOnUpdate()
;               
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('atendimentos', function (Blueprint $table) {
            //
            $table->dropColumn('nome');
            $table->dropColumn('data_agendada');
            $table->dropColumn('hora_comparecimento');
            $table->dropColumn('posicao_fila');
            $table->dropColumn('data_agendada');
            $table->dropColumn('agendamento_id');
        });
    }
};
