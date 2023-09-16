<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserindo através do objeto
        $fornecedor = new Fornecedor();

        $fornecedor->nome   = 'Fornecedor 100';
        $fornecedor->site   = 'fornecedor100.com.br';
        $fornecedor->uf     = 'CE';
        $fornecedor->email  = 'contato@fornecedor100.com.br';
        
        $fornecedor->save();

        // Inserindo utilizando método estático (precisa definir os campos na protected fillable no model)
        Fornecedor::create([
            'nome'      => 'Fornecedor 200',
            'site'      => 'fornecedor200.com.br',
            'uf'        => 'MG',
            'email'    => 'contato@fornecedor200.com.br'
        ]);

        // Insert
        DB::table('fornecedores')->insert([
            'nome'      => 'Fornecedor 300',
            'site'      => 'fornecedor300.com.br',
            'uf'        => 'MG',
            'email'    => 'contato@fornecedor300.com.br'
        ]);
    }
}
