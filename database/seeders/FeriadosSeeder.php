<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feriado;
use Carbon\Carbon;

class FeriadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
      $ano = now()->year;

        // Lista de feriados fixos
        $feriadosFixos = [
            ['data' => "$ano-01-01", 'descricao' => 'Confraternização Universal'],
            ['data' => "$ano-04-21", 'descricao' => 'Tiradentes'],
            ['data' => "$ano-05-01", 'descricao' => 'Dia do Trabalho'],
            ['data' => "$ano-09-07", 'descricao' => 'Independência do Brasil'],
            ['data' => "$ano-10-12", 'descricao' => 'Nossa Senhora Aparecida'],
            ['data' => "$ano-11-02", 'descricao' => 'Finados'],
            ['data' => "$ano-11-15", 'descricao' => 'Proclamação da República'],
            ['data' => "$ano-12-25", 'descricao' => 'Natal'],
        ];

        // Feriados móveis (calculados a partir da Páscoa)
        $pascoa = $this->calcularPascoa($ano);
        $feriadosMoveis = [
            ['data' => $pascoa->copy()->subDays(47)->format('Y-m-d'), 'descricao' => 'Carnaval'],
            ['data' => $pascoa->copy()->subDays(46)->format('Y-m-d'), 'descricao' => 'Carnaval (terça-feira)'],
            ['data' => $pascoa->copy()->subDays(2)->format('Y-m-d'), 'descricao' => 'Sexta-feira Santa'],
            ['data' => $pascoa->format('Y-m-d'), 'descricao' => 'Domingo de Páscoa'],
            ['data' => $pascoa->copy()->addDays(60)->format('Y-m-d'), 'descricao' => 'Corpus Christi'],
        ];

        // Inserindo no banco (evita duplicação)
        foreach (array_merge($feriadosFixos, $feriadosMoveis) as $feriado) {
            Feriado::firstOrCreate(['data' => $feriado['data']], ['descricao' => $feriado['descricao']]);
        }
    }

    private function calcularPascoa($ano)
    {
        // Algoritmo de cálculo da Páscoa (algoritmo de Gauss)
        $a = $ano % 19;
        $b = intdiv($ano, 100);
        $c = $ano % 100;
        $d = intdiv($b, 4);
        $e = $b % 4;
        $f = intdiv($b + 8, 25);
        $g = intdiv($b - $f + 1, 3);
        $h = (19 * $a + $b - $d - $g + 15) % 30;
        $i = intdiv($c, 4);
        $k = $c % 4;
        $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
        $m = intdiv($a + 11 * $h + 22 * $l, 451);
        $mes = intdiv($h + $l - 7 * $m + 114, 31);
        $dia = (($h + $l - 7 * $m + 114) % 31) + 1;

        return Carbon::createFromDate($ano, $mes, $dia);
    }
}
