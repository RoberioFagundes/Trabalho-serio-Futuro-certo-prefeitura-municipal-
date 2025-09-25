// database/seeders/PessoasSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pessoas')->insert([
            ['id' => 1, 'nome' => 'João da Silva', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nome' => 'Maria Souza', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nome' => 'Carlos Oliveira', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
