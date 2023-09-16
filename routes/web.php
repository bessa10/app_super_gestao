<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return 'Olá seja bem vindo ao curso';
});

Route::get('/sobre-nos', function () {
    return 'Sobre Nós';
});

Route::get('/contato', function () {
    return 'Contato';
});

Routes version 7
Route::get('/', 'PrincipalController::class@principal');
Route::get('/sobre-nos', 'SobreNosController@sobreNos');
Route::get('/contato', 'ContatoController@contato');
*/

/*
Routes version 8

? usado para deixar a rota opcional
Route::get('/contato/{nome}/{categoria}/{assunto}/{mensagem?}', 
    function(
        string $nome,
        string $categoria, 
        string $assunto, 
        string $mensagem = ''
    ){

    echo "Nome: $nome <br>Categoria: $categoria<br> Assunto: $assunto<br>Mensagem; $mensagem";
});

-- usando expressões regulares na validação de rotas
Route::get('/contato/{nome}/{categoria_id}', 
    function(
        string $nome,
        int $categoria_id = 1 // 1 - informação
    ){

    echo "Nome: $nome <br>Categoria: $categoria_id";
})->where('categoria_id', '[0-9]+')->where('nome', '[A-Za-z]+'); 
// Tratar os parâmetros através de expressão regular para evitar erros (nesse caso ele espera apenas números, e precisa enviar no mínimo 1 digito)

Redirecionamento de rotas
// Redirecionamento de rotas
Route::get('/rota1', function(){
    echo 'Rota 1';
})->name('site.rota1');

Route::get('/rota2', function(){
    return redirect()->route('site.rota1');
})->name('site.rota2');

// Método do objeto Route
//Route::redirect('/rota2', '/rota1');

*/

use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Middleware\LogAcessoMiddleware;

//middleware(LogAcessoMiddleware::class)
Route::get('/', [PrincipalController::class, 'principal'])
    ->name('site.index')
    ->middleware('log.acesso');

Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');

Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');

Route::get('/login/{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('site.login');

// Redirecionamento de rotas
Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('site.teste');

//app
Route::middleware('log.acesso','autenticacao:padrao,p1,p2')->prefix('/app')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');
    Route::get('/cliente', [ClienteController::class, 'index'])->name('app.cliente');
    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::post('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', [FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', [FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');
    Route::get('/produto', [ProdutoController::class, 'index'])->name('app.produto');

});

Route::fallback(function(){

    echo 'A rota acessada não existe. <a href="'.route('site.index').'">Clique aqui</a> para ir para a página inicial.';

});