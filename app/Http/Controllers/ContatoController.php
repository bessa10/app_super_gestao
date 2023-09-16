<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SiteContato;
use App\Models\MotivoContato;
use Illuminate\Support\Facades\Redis;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {      
        //$contato = new SiteContato();

        /*
        ## FORMA 1- Inserir registros
        $contato->nome              = $request->input('nome');
        $contato->telefone          = $request->input('telefone');
        $contato->email             = $request->input('email');
        $contato->motivo_contato    = $request->input('motivo_contato');
        $contato->mensagem          = $request->input('mensagem');
        $contato->save();
        */

        ## FORMA 2 - Inserir registros
        //$contato->fill($request->all());
        //$contato->save();

        ## FORMA 3 - Inserir registros
        //$contato->create($request->all());

        //echo '<pre>';
        //print_r($contato->getAttributes());
        //print_r($request->all());
        //echo '</pre>';

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request)
    {
        // Realizando validação
        // Validção exemplo unique:site_contatos

        $request->validate(
            [
                'nome'                  => 'required|min:3|max:40',
                'telefone'              => 'required',
                'email'                 => 'email',
                'motivo_contatos_id'    => 'required',
                'mensagem'              => 'required'
            ],
            [
                'nome.required' => 'O campo nome é obrigatório',
                'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'required' => 'O campo :attribute deve ser preenchido' 
            ]
        );

        SiteContato::create($request->all());

        return redirect()->route('site.index');
    }
}
