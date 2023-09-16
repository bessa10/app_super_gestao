@extends('app.layouts.basico');
@section('titulo', 'Cliente');
@section('conteudo')

<div class="conteudo-pagina">
    <div class="titulo-pagina">
        <p>Fornecedor - Lista</p>
    </div>
    <div class="menu">
        <ul>
            <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
            <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
        </ul>
    </div>

    <div class="informacao-pagina">
        <div style="width:90%;margin-left:auto;margin-right:auto">
            <table border="1" width="100%">
                <thead> 
                    <th>Nome</th>
                    <th>Site</th>
                    <th>UF</th>
                    <th>E-mail</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </thead>
                <tbody>
                    @foreach ($fornecedores as $fornecedor)
                        <tr>
                            <td>{{ $fornecedor->nome }}</td>
                            <td>{{ $fornecedor->site }}</td>
                            <td>{{ $fornecedor->uf }}</td>
                            <td>{{ $fornecedor->email }}</td>
                            <td><a href="{{ route('app.fornecedor.editar', $fornecedor->id) }}">Editar</a></td>
                            <td><a href="{{ route('app.fornecedor.excluir', $fornecedor->id) }}">Excluir</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $fornecedores->appends($request)->links() }}
            <br>
            {{ $fornecedores->count() }} - total registro por página
            <br>
            {{ $fornecedores->total() }} - total registro da consulta
            <br>
            {{ $fornecedores->firstItem() }} - Número primeiro registro da página
            <br>
            {{ $fornecedores->lastItem() }} - Número último registro da página
        </div>
    </div>
</div>

@endsection 