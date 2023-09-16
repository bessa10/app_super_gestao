<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteContato;
use Carbon\Factory;
use Database\Factories\SiteContatoFactory;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*
        $contato = new SiteContato();

        $contato->nome              = 'Sistema SG';
        $contato->telefone          = '(11) 99999-9999';
        $contato->email             = 'contato@sg.com.br';
        $contato->motivo_contato    = 1;
        $contato->mensagem          = 'Seja bem vindo ao sistema super gestão';

        $contato->save();
        */
        \App\Models\SiteContato::factory(20)->create();
    }
}
