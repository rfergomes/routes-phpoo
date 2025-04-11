<?php

namespace App\Controllers;

use php_user_filter;
use app\support\Flash;
use app\database\Filters;
use app\support\Validate;
use app\database\models\Nivel;
use app\Controllers\Controller;
use app\core\Request;
use app\core\Session;
use app\database\models\Modulo;
use app\database\models\Permission;
use app\middleware\PermissionMiddleware;

class PermissoesController extends Controller
{
   protected $permissao;
   protected $modulo;
   protected $nivel;
   protected $moduloId = 13;
   protected $moduloName = 'permissoes';
   protected $viewFolder = 'permissoes';
   public function __construct()
   {
      $this->permissao = new Permission();
      $this->modulo = new Modulo;
      $this->nivel = new Nivel;
   }
   public function index()
   {
      PermissionMiddleware::check($this->moduloId, 'ver');
      $nivel_id = filter_input(INPUT_GET, "nivel_id", FILTER_SANITIZE_SPECIAL_CHARS) ?? 1;

      $filters = new Filters;

      $filters->where('nivel_id', '=', $nivel_id);
      $filters->join('modulos', 'modulos.id', '=', 'permissions.modulo_id', 'left join');

      $this->permissao = new Permission();
      $this->permissao->setFields('permissions.*, modulos.nome as modulo_nome');
      $this->permissao->setFilters($filters);
      $permissoes = $this->permissao->fetchAll();
      $this->nivel = new Nivel();
      $niveis = $this->nivel->fetchAll();


      return $this->view("{$this->viewFolder}/index", [
         'title' => 'Permissões',
         'permissoes' => $permissoes,
         'niveis' => $niveis,
         'nivel_id' => $nivel_id
      ]);
   }

   public function save()
   {

      $inputs = Request::all();
      $validated=new Validate();
      $nivel_id = $inputs['nivel_id'];
      $dados = $inputs['permissoes'];

      $this->permissao = new Permission();

      // Limpa permissões atuais
      //$this->permissao->deleteWhere(['nivel_id' => $nivel_id]);

      // Insere as novas permissões
      foreach ($dados as $modulo_id => $acoes) {
         $filters = (new Filters())
            ->where('nivel_id', '=', $nivel_id, 'and')
            ->where('modulo_id', '=', $modulo_id);

         $this->permissao->setFilters($filters);

         $exists = $this->permissao->fetchAll();
$msg='';
         if ($exists) {
            // Atualiza

            $result = $this->permissao->update('id', $exists[0]->id, [
               'pode_ver' => isset($acoes['ver']) ? 1 : 0,
               'pode_editar' => isset($acoes['editar']) ? 1 : 0,
               'pode_adicionar' => isset($acoes['adicionar']) ? 1 : 0,
               'pode_excluir' => isset($acoes['excluir']) ? 1 : 0,
            ]);
            $msg='Permissões atualizadas com sucesso!';
         } else {
            // Insere

            $this->permissao->create([
               'nivel_id' => $nivel_id,
               'modulo_id' => $modulo_id,
               'pode_ver' => isset($acoes['ver']) ? 1 : 0,
               'pode_editar' => isset($acoes['editar']) ? 1 : 0,
               'pode_adicionar' => isset($acoes['adicionar']) ? 1 : 0,
               'pode_excluir' => isset($acoes['excluir']) ? 1 : 0,
            ]);
            $msg= 'Permisão adicionada com sucesso!';
         }
      }

      // Redirecionar com sucesso
      redirect("/permissao?nivel_id=$nivel_id", 'success', $msg);
   }

   /* Exemplo de uso
   $filters = (new Filters())
      ->where('users.age', '>', 18)
      ->where('users.name', 'LIKE', 'rodrigo')
      ->join('orders', 'users.id', '=', 'orders.user_id')
      ->orderBy('users.created_at', 'DESC')
      ->limit(10);
   */

   public function create()
   {
      PermissionMiddleware::check($this->moduloId, 'adicionar');

      $this->nivel = new Nivel();
      $niveis = $this->nivel->fetchAll();

      $this->permissao = new Permission();
      $this->permissao->setFields('modulo_id');
      $permissoes = $this->permissao->fetchAll();

      $lista_ids = $lista_ids = implode(',', array_map(fn($p) => $p->modulo_id, $permissoes));

      $this->modulo = new Modulo();
      $filters = (new Filters())
         ->where('id', 'NOT IN', [$lista_ids])
         ->orderBy('id', 'ASC');

      /*
      $sql = $filters->dump();
      $binds = $filters->getBind();
      dd(['SQL' => $sql, 'Binds' => $binds]);
      */

      $this->modulo->setFilters($filters);

      $modulos = $this->modulo->fetchAll();

      if (!$modulos) {
         redirect('/permissao', 'warning', 'Todos os módulos já possuem permissões');
      }

      $this->view('permissoes/create', [
         'title' => 'Criar Permissão',
         'niveis' => $niveis,
         'modulos' => $modulos
      ]);
   }
   public function edit($params)
   {
      PermissionMiddleware::check($this->moduloId, 'editar');
      $nivel = $this->nivel->findBy('nivel_id', $params[0]);
      $modulos = $this->modulo->fetchAll();
      $permissoes = $this->permissao->getPermissionsByLevel($params[0]);
      $this->view('permission/edit', compact('nivel', 'modulos', 'permissoes'));
   }
   public function update($params)
   {
      $this->view('permissoes/update', [
         'title' => 'Atualizar Permissão',
      ]);
   }
   public function delete($params)
   {
      PermissionMiddleware::check($this->moduloId, 'deletar');
      $this->view('permissoes/delete', [
         'title' => 'Deletar Permissão',
      ]);
   }
   public function show($params)
   {
      PermissionMiddleware::check($this->moduloId, 'ver');
      $this->view('permissoes/show', [
         'title' => 'Ver Permissão',
      ]);
   }
   public function store()
   {
      PermissionMiddleware::check($this->moduloId, 'criar');
      $this->view('permissoes/store', [
         'title' => 'Criar Permissão',
      ]);
   }
   public function destroy($params)
   {
      PermissionMiddleware::check($this->moduloId, 'deletar');
      $this->view('permissoes/destroy', [
         'title' => 'Deletar Permissão',
      ]);
   }
   public function updatePermission($params)
   {
      PermissionMiddleware::check($this->moduloId, 'editar');
      $this->view('permissoes/updatePermission', [
         'title' => 'Atualizar Permissão',
      ]);
   }
   public function deletePermission($params)
   {
      PermissionMiddleware::check($this->moduloId, 'deletar');
      $this->view('permissoes/deletePermission', [
         'title' => 'Deletar Permissão',
      ]);
   }
   public function showPermission($params)
   {
      PermissionMiddleware::check($this->moduloId, 'ver');
      $this->view('permissoes/showPermission', [
         'title' => 'Ver Permissão',
      ]);
   }
   public function storePermission()
   {
      PermissionMiddleware::check($this->moduloId, 'criar');
      $this->view('permissoes/storePermission', [
         'title' => 'Criar Permissão',
      ]);
   }
   public function destroyPermission($params)
   {
      PermissionMiddleware::check($this->moduloId, 'deletar');
      $this->view('permissoes/destroyPermission', [
         'title' => 'Deletar Permissão',
      ]);
   }
}
