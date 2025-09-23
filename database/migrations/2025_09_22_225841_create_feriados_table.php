<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('feriados', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('dia_semana')->nullable(); // ou dia_semana (melhor)
            $table->string('descricao');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('feriados');
    }
};
