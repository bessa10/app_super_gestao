<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::where('nome', 'like', '%'.$request->input('nome').'%')
            ->where('site', 'like', '%'.$request->input('site').'%')
            ->where('uf', 'like', '%'.$request->input('uf').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')
            ->paginate(2);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request)
    {   
        $msg = '';

        // adição
        if($request->input('_token') != '' && $request->input('id') == '') {
            // Validando os dados
            $regras = [
                'nome'  => 'required|min:3|max:40',
                'site'  => 'required',
                'uf'    => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caractertes',
                'nome.max' => 'O campo nome deve ter no máximo 40 caractertes',
                'uf.min' => 'O campo UF deve ter no mínimo 2 caractertes',
                'uf.max' => 'O campo UF deve ter no máximo 2 caractertes',
                'email.email' => 'O e-mail informádo é inválido'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();

            $fornecedor->create($request->all());

            // redirect

            // msg sucesso
            $msg = 'Cadastro realizado com sucesso';

        }

        // edição
        if($request->input('_token') != '' && $request->input('id') != '') {

            $fornecedor = Fornecedor::find($request->input('id'));

            $update = $fornecedor->update($request->all());

            if($update) {
                $msg = 'Fornecedor alterado com sucesso';
            } else {
                $msg = 'Não foi possível alterar o fornecedor';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);

        }

        return view('app.fornecedor.adicionar', compact('msg'));
    }

    public function editar($id, $msg = '')
    {
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', compact('msg', 'fornecedor'));

    }

    public function excluir($id)
    {
        Fornecedor::find($id)->delete(); // atribui o deleted at
        //Fornecedor::find($id)->forceDelete(); // deleta fisicamente

        return redirect()->route('app.fornecedor');
    }
}
