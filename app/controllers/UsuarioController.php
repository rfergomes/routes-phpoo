<?php

namespace app\controllers;

use app\support\Flash;
use app\support\Validate;
use app\database\Filters;
use app\database\Pagination;
use app\database\models\Usuario;
use app\controllers\Controller;
use app\middleware\PermissionMiddleware;

class UsuarioController extends Controller
{
    protected string $viewFolder = 'usuarios';
    protected $usuario;
    public function __construct()
    {
        $this->usuario=new Usuario();
    }

    public function index()
    {
        PermissionMiddleware::check(1, 'ver');
        $search = filter_input(INPUT_GET, "search", FILTER_SANITIZE_SPECIAL_CHARS);
        $itemPerpage = filter_input(INPUT_GET, "items", FILTER_SANITIZE_SPECIAL_CHARS);

        $filters = new Filters;
        if ($search) {
            $filters->where('name', 'LIKE', $search);
        }
        //$filters->join('user_groups', 'users.user_level', '=', 'user_groups.group_level', 'left join');

        $pagination = new Pagination;
        $pagination->setItemsPerPage($itemPerpage ?: 10);

        $this->usuario->setFilters($filters);
        $this->usuario->setPagination($pagination);

        $usersFound = $this->usuario->fetchAll();
        $count = $this->usuario->count();

        $this->view("{$this->viewFolder}/index", [
            'title' => 'Lista de usuários',
            'users' => $usersFound,
            'count' => $count,
            'pagination' => $pagination,
        ]);
    }

    public function create()
    {
        PermissionMiddleware::check(1, 'adicionar');
        $this->view("{$this->viewFolder}/create", ['title' => 'Criar user']);
    }

    public function edit($params)
    {
        PermissionMiddleware::check(1, 'editar');
        if (!is_array($params) || empty($params[0]) || !is_numeric($params[0])) {
            return redirect("/404");
        }

        $id = $params[0];
        $filters = new Filters;
        $filters->where('id', '=', $id);
        $filters->limit(1);

        $this->usuario->setFilters($filters);
        $usersFound = $this->usuario->fetchAll();

        if (!$usersFound) {
            return redirect("/404");
        }

        $this->view("{$this->viewFolder}/edit", [
            'title' => "{$this->viewFolder}/Alterar",
            'user' => $usersFound,
        ]);
    }

    public function save()
    {
        $validate = new Validate;

        $validated = $validate->validate([
            'id' => 'optional',
            'nome' => 'required',
            'email' => 'email|required|unique:' . Usuario::class,
            'senha' => 'required|maxLen:5|minLen:3',
            'nivel_id' => 'required',
            'status' => 'required'
        ], persistInputs: true);

        $inputs = $validate->getInputs();
        $id = $inputs['id'];

        if (!$validated) {
            return redirect($id > 0 ? "/usuario/edit/{$id}" : "/usuario/create");
        }

        $validated['senha'] = password_hash($validated['senha'], PASSWORD_DEFAULT);

        if ($validated['id'] > 0) {
            $result = $this->usuario->update('id', $validated['id'], $validated);
            Flash::set($result ? 'success' : 'danger', $result ? "Usuário atualizado com sucesso!" : "Erro ao atualizar usuário!");
            return redirect("/usuario");
        } else {
            unset($validated['id']);
            $result = $this->usuario->create($validated);
            Flash::set($result ? 'success' : 'danger', $result ? "Usuário criado com sucesso!" : "Erro ao criar usuário!");
            return redirect("/usuario");
        }
    }

    public function delete($params)
    {
        PermissionMiddleware::check(1, 'excluir');
        if (!is_array($params) || empty($params[0]) || !is_numeric($params[0])) {
            return redirect("/404");
        }

        $return = $this->usuario->delete('id', $params[0]);
        Flash::set($return ? 'success' : 'danger', $return ? "Usuário excluído com sucesso!" : "Erro ao excluir usuário!");
        return redirect("/usuario");
    }
}
