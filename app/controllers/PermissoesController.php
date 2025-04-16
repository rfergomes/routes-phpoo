<?php

namespace App\Controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\models\Nivel;
use app\Controllers\Controller;
use app\core\Request;
use app\database\models\Modulo;
use app\database\models\Permission;
use app\middleware\PermissionMiddleware;

class PermissoesController extends Controller
{
   protected $permissao;
   protected $modulo;
   protected $nivel;
   protected $moduloId = 13;
   protected $moduloName = 'permissions';
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
      $filters->orderBy('nome','ASC');

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

   public function create()
   {
      PermissionMiddleware::check($this->moduloId, 'adicionar');

      $this->nivel = new Nivel();
      $niveis = $this->nivel->fetchAll();

      $this->modulo = new Modulo();
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

   public function save()
   {

      $inputs = Request::all();

      $nivel_id = $inputs['nivel_id'];
      $dados = $inputs['permissoes'] ?? '';
      //dd($dados[1]['adicionar']);
      $this->permissao = new Permission();

      // Limpa permissões atuais
      if ($nivel_id > 1) {
         //$this->permissao->deleteWhere(['nivel_id' => $nivel_id]);
      }

      if (!empty($dados)) {

         // Insere as novas permissões
         foreach ($dados as $modulo_id => $acoes) {
            $filters = (new Filters())
               ->where('nivel_id', '=', $nivel_id, 'and')
               ->where('modulo_id', '=', $modulo_id);

            $this->permissao->setFilters($filters);

            $exists = $this->permissao->fetchAll();

            if ($acoes['ver'] == 0) {
               $data = [
                  'pode_ver' => 0,
                  'pode_editar' =>0,
                  'pode_adicionar' => 0,
                  'pode_excluir' => 0,
               ];
            } else {
               $data = [
                  'pode_ver' => 1,
                  'pode_editar' => $acoes['editar'] != 0 ? 1 : 0,
                  'pode_adicionar' => $acoes['adicionar'] != 0 ? 1 : 0,
                  'pode_excluir' => $acoes['excluir'] != 0 ? 1 : 0,
               ];
            }
            if ($exists) {              
               // Edita
               $this->permissao->update('id', $exists[0]->id, $data);
               $msg="Permissões atualizadas com sucesso!";
            } else {
               // Adiciona
               $this->permissao->create(array_merge($data, [
                  'nivel_id' => $nivel_id,
                  'modulo_id' => $modulo_id,
               ]));
               $msg="Permisões Adicionadas com sucesso!";
            }
         }
         redirect("/permissao?nivel_id=$nivel_id", 'success', $msg);
      } else {
         redirect("/permissao?nivel_id=$nivel_id", 'info', 'Nenhuma permissão foi informada.');
      }
   }

   /* Exemplo de uso
   $filters = (new Filters())
      ->where('users.age', '>', 18)
      ->where('users.name', 'LIKE', 'rodrigo')
      ->join('orders', 'users.id', '=', 'orders.user_id')
      ->orderBy('users.created_at', 'DESC')
      ->limit(10);
   */

   
}
