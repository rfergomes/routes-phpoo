<?php

namespace app\controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\Controllers\Controller;
use app\database\models\Menu;
use app\middleware\PermissionMiddleware;

class MenuController extends Controller
{
    protected $menu;
    protected $moduloName = 'menu';
    protected $moduloId = 18;
    protected $viewFolder = 'menus';

    public function __construct()
    {
        $this->menu = new Menu();
    }

    public function index()
    {
        PermissionMiddleware::check($this->moduloId, 'ver');
        $search = filter_input(INPUT_GET, "search", FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $itemPerpage = filter_input(INPUT_GET, "items", FILTER_SANITIZE_SPECIAL_CHARS) ?? 10;

        $filters = (new Filters())
            ->where('nome', 'LIKE', $search)
            ->orderby('nome', 'ASC');

        $pagination = new Pagination;
        $pagination->setItemsPerPage($itemPerpage ?? 10);

        $this->menu->setFilters($filters);
        $this->menu->setPagination($pagination);

        $menus = $this->menu->fetchAll();
        $count = $this->menu->count();

        $this->view("{$this->viewFolder}/index", [
            'title' => ucfirst($this->viewFolder),
            'moduloId' => $this->moduloId,
            'menus' => $menus,
            'pagination' => $pagination,
            'count' => $count,
            'itemPerPage' => $itemPerpage
        ]);
    }

    public function create()
    {
        PermissionMiddleware::check($this->moduloId, 'adicionar');

        $menu = new Menu();
        $menus = $menu->fetchAll();

        $this->view("{$this->viewFolder}/create", [
            'title' => 'Criar Menu',
            'menus' => $menus
        ]);
    }

    public function edit($params)
    {

        PermissionMiddleware::check($this->moduloId, 'editar');
        if (!is_array($params) || empty($params[0]) || !is_numeric($params[0])) {
            return redirect("/404");
        }

        $id = $params[0];

        $menus = $this->menu->findBy('id', $id);

        if (!$menus) {
            return redirect("/404");
        }

        $this->view("{$this->viewFolder}/edit", [
            'title' => 'Editar Menu',
            'moduloId' => $id,
            'menu' => $menus
        ]);
    }

    public function save()
    {
        PermissionMiddleware::check($this->moduloId, 'editar');
        PermissionMiddleware::check($this->moduloId, 'adicionar');
        $validate = new Validate;
        $validated = $validate->validate([
            'id' => 'optional',
            'nome' => 'required',
            'descricao' => 'required',
            'icone' => 'required'
        ], persistInputs: true);

        $inputs = $validate->getInputs();
        $id = $inputs['id'];

        if (!$validated) {
            return redirect($id > 0 ? "/{$this->moduloName}/edit/{$id}" : "/{$this->moduloName}/create", 'warning', 'Verifique os campos obrigatórios');
        }

        if ($id) {
            // Editar Módulo
            $result = $this->menu->update('id', $id, $validated);
            return redirect(
                "/{$this->moduloName}",
                $result ? 'success' : 'danger',
                $result ? 'Menu atualizado com sucesso!' : 'Falha ao atualizar Menu'
            );
        } else {
            // Cadastrar Módulo
            $result = $this->menu->create($validated);
            return redirect(
                "/{$this->moduloName}",
                $result ? 'success' : 'danger',
                $result ? 'Menu Adicionado com sucesso!' : 'Falha ao adicionar Menu'
            );
        }
    }

    public function delete($params)
    {
        PermissionMiddleware::check($this->moduloId, 'excluir');
        if (!is_array($params) || empty($params[0]) || !is_numeric($params[0])) {
            return redirect("/404");
        }

        $result = $this->menu->delete('id', $params[0]);
        return redirect(
            "/{$this->moduloName}",
            $result ? 'success' : 'danger',
            $result ? 'Menu Adicionado com sucesso!' : 'Falha ao adicionar Menu'
        );
    }
}
