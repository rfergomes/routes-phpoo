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

                // Ativo
                '/ativo' => 'AtivoController@index',
                '/ativo/show' => 'AtivoController@show',
                '/ativo/create' => 'AtivoController@create',
                '/ativo/edit/[0-9]+' => 'AtivoController@edit',
                '/ativo/delete/[0-9]+'=> 'AtivoController@delete',

                // Categoria
                '/categoria' => 'CategoriaController@index',
                '/categoria/show' => 'CategoriaController@show',
                '/categoria/create' => 'CategoriaController@create',
                '/categoria/edit/[0-9]+' => 'CategoriaController@edit',
                '/categoria/delete/[0-9]+'=> 'CategoriaController@delete',

                // Equipamento
                '/equipamento' => 'EquipamentoController@index',
                '/equipamento/show' => 'EquipamentoController@show',
                '/equipamento/create' => 'EquipamentoController@create',
                '/equipamento/edit/[0-9]+' => 'EquipamentoController@edit',
                '/equipamento/delete/[0-9]+'=> 'EquipamentoController@delete',

                // Permissão
                '/permissao' => 'PermissoesController@index',
                '/permissao/create' => 'PermissoesController@create',
                '/permissao/edit/[0-9]+' => 'PermissoesController@edit',
                
                // Fabricante
                '/fabricante' => 'FabricanteController@index',
                '/fabricante/show'=> 'FabricanteController@show',
                '/fabricante/create' => 'FabricanteController@create',
                '/fabricante/edit/[0-9]+' => 'FabricanteController@edit',
                '/fabricante/delete/[0-9]+' => 'FabricanteController@delete',

                // Fornecedor
                '/fornecedor' => 'FornecedorController@index',
                '/fornecedor/show'=> 'FornecedorController@show',
                '/fornecedor/create' => 'FornecedorController@create',
                '/fornecedor/edit/[0-9]+' => 'FornecedorController@edit',
                '/fornecedor/delete/[0-9]+' => 'FornecedorController@delete',

                // Transferência
                '/transferencia' => 'TransferenciaController@index',
                '/transferencia/create' => 'TransferenciaController@create',
                '/transferencia/edit/[0-9]+' => 'TransferenciaController@edit',
                '/transferencia/delete/[0-9]+' => 'TransferenciaController@delete',

                // Localizações
                '/localizacao' => 'LocalizacaoController@index',
                '/localizacao/create' => 'LocalizacaoController@create',
                '/localizacao/edit/[0-9]+' => 'LocalizacaoController@edit',
                '/localizacao/delete/[0-9]+' => 'LocalizacaoController@delete',
                '/localizacao/show/[0-9]+' => 'LocalizacaoController@show',

                // Menus
                '/menu' => 'MenuController@index',
                '/menu/create' => 'MenuController@create',
                '/menu/edit/[0-9]+' => 'MenuController@edit',
                '/menu/delete/[0-9]+' => 'MenuController@delete',
                '/menu/show/[0-9]+' => 'MenuController@show',

                //Módulos
                '/modulo' => 'ModuloController@index',
                '/modulo/create' => 'ModuloController@create',
                '/modulo/edit/[0-9]+' => 'ModuloController@edit',
                '/modulo/delete/[0-9]+' => 'ModuloController@delete',
                '/modulo/show/[0-9]+' => 'ModuloController@show',                

                // Níveis de permissão
                '/nivel'=> 'NivelController@index',
                '/nivel/create'=>  'NivelController@create',
                '/nivel/edit/[0-9]+'=> 'NivelController@edit',
                '/nivel/delete/[0-9]+'=>  'NivelController@delete',
                
                // Outros controllers (adicione conforme necessário)
                '/emprestimo' => 'EmprestimoController@index',
                '/manutencao' => 'ManutencaoController@index',
                '/maintenance' => 'MaintenanceController@index',
                
                '/historico' => 'HistoricoMovimentacaoController@index',
                '/log-sistema' => 'LogSistemaController@index',
                
                // Softwares
                '/software' => 'SoftwaresController@index',
                '/software/create' => 'SoftwaresController@create',
                '/software/edit/[0-9]+' => 'SoftwaresController@edit',
                '/software/delete/[0-9]+' => 'SoftwaresController@delete',

                // Fallback
                '/404' => 'NotFoundController@index',
            ],
            'post' => [
                // Auth
                '/login' => 'AuthController@authenticate',

                // Usuário
                '/usuario/save' => 'UsuarioController@save',

                // Ativo
                '/ativo/save' => 'AtivoController@save',
                
                // Equipamento
                '/equipamento/save' => 'EquipamentoController@save',

                // Categoria
                '/categoria/save'=> 'CategoriaController@save',

                // Fabricante
                '/fabricante/save' => 'FabricanteController@save',

                // Fornecedor
                '/fornecedor/save' => 'FornecedorController@save',

                // Localização
                '/localizacao/save' => 'LocalizacaoController@save',

                // Menu
                '/menu/save'=> 'MenuController@save',

                // Módulo
                '/modulo/save'=> 'ModuloController@save',

                // Nível
                '/nivel/save'=> 'NivelController@save',

                // Permissão
                '/permissao/save'=> 'PermissoesController@save',

                // Transferência
                '/transferencia/save' => 'TransferenciaController@save',

                // Adicione mais conforme necessário
            ]
        ];
    }
}
