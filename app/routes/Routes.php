<?php
namespace app\routes;

class Routes
{
    public static function get()
    {
        return [
            'get' => [
                '/' => 'HomeController@index',

                // Auth
                '/login' => 'AuthController@login',
                '/logout' => 'AuthController@logout',
                '/unauthorized' => 'AuthController@unauthorized',

                // Usuário
                '/usuario' => 'UsuarioController@index',
                '/usuario/create' => 'UsuarioController@create',
                '/usuario/edit/[0-9]+' => 'UsuarioController@edit',
                '/usuario/delete/[0-9]+' => 'UsuarioController@delete',
                '/usuario/show/[0-9]+/[a-zA-Z]+' => 'UsuarioController@show',

                // Permissão
                '/permissao' => 'PermissoesController@index',
                '/permissao/create' => 'PermissoesController@create',
                '/permissao/edit/[0-9]+' => 'PermissoesController@edit',
                
                // Fabricante
                '/fabricante' => 'FabricanteController@index',
                '/fabricante/create' => 'FabricanteController@create',
                '/fabricante/edit/[0-9]+' => 'FabricanteController@edit',
                '/fabricante/delete/[0-9]+' => 'FabricanteController@delete',

                // Fornecedor
                '/fornecedor' => 'FornecedorController@index',
                '/fornecedor/create' => 'FornecedorController@create',
                '/fornecedor/edit/[0-9]+' => 'FornecedorController@edit',
                '/fornecedor/delete/[0-9]+' => 'FornecedorController@delete',

                // Transferência
                '/transferencia' => 'TransferenciaController@index',
                '/transferencia/create' => 'TransferenciaController@create',
                '/transferencia/edit/[0-9]+' => 'TransferenciaController@edit',
                '/transferencia/delete/[0-9]+' => 'TransferenciaController@delete',

                //Módulos
                '/modulo' => 'ModuloController@index',
                '/modulo/create' => 'ModuloController@create',
                '/modulo/edit/[0-9]+' => 'ModuloController@edit',
                '/modulo/delete/[0-9]+' => 'ModuloController@delete',
                '/modulo/show/[0-9]+' => 'ModuloController@show',
                
                // Outros controllers (adicione conforme necessário)
                '/emprestimo' => 'EmprestimoController@index',
                '/manutencao' => 'ManutencaoController@index',
                '/maintenance' => 'MaintenanceController@index',
                '/softwares' => 'SoftwaresController@index',
                '/historico' => 'HistoricoMovimentacaoController@index',
                '/log-sistema' => 'LogSistemaController@index',
                '/categoria' => 'CategoriaController@index',

                // Fallback
                '/404' => 'NotFoundController@index',
            ],
            'post' => [
                // Auth
                '/login' => 'AuthController@authenticate',

                // Usuário
                '/usuario/save' => 'UsuarioController@save',

                // Fabricante
                '/fabricante/save' => 'FabricanteController@save',

                // Fornecedor
                '/fornecedor/save' => 'FornecedorController@save',

                // Módulo
                '/modulo/save'=> 'ModuloController@save',

                // Permissão
                '/permissao/save'=> 'PermissoesController@save',

                // Transferência
                '/transferencia/save' => 'TransferenciaController@save',

                // Adicione mais conforme necessário
            ]
        ];
    }
}
