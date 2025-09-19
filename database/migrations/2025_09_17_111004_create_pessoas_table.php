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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cpf')->unique()->nullable();
            $table->string('rg')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('cartao_sus')->unique()->nullable();
            $table->string('telefone')->nullable();

            // Forma correta de criar a foreign key para users.id
            $table->foreignId('user_id')
                ->constrained('users')      // referencia users.id
                ->cascadeOnDelete()         // exclui pessoa se user for excluído
                ->cascadeOnUpdate();        // atualiza user_id se id mudar

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas');
    }
};
