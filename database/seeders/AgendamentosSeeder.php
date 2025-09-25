<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AgendamentosSeeder extends Seeder
{
    /**
     * Executa o seeder.
     */
    public function run(): void
    {
        DB::table('agendamentos')->insert([
            [
                'data_Hora'   => Carbon::now()->addDays(1)->format('Y-m-d H:i:s'),
                'local'      => 'Sala 101 - Prédio A',
                'observacoes'=> 'Primeiro agendamento de teste.',
                'user_id'    => 1,
                'pessoa_id'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'arquivo'    => 'documento1.pdf',
                'hora'       => '08:00:00',
            ],
            [
                'data_Hora'   => Carbon::now()->addDays(2)->format('Y-m-d H:i:s'),
                'local'      => 'Sala 202 - Prédio B',
                'observacoes'=> 'Segundo agendamento de teste.',
                'user_id'    => 1,
                'pessoa_id'  => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'arquivo'    => 'documento2.pdf',
                'hora'       => '09:30:00',
            ],
            [
                'data_Hora'   => Carbon::now()->addDays(3)->format('Y-m-d H:i:s'),
                'local'      => 'Auditório Principal',
                'observacoes'=> 'Reunião geral com todos os usuários.',
                'user_id'    => 2,
                'pessoa_id'  => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'arquivo'    => 'pauta_reuniao.pdf',
                'hora'       => '14:00:00',
            ],
        ]);
    }
}
