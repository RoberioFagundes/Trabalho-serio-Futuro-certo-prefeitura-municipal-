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
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->string('arquivo')->nullable(); // exemplo: string, pode ser integer, boolean, etc.
        });
    }

    public function down(): void
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->dropColumn('arquivo'); // desfaz a alteração
        });
    }
};
