<?php

namespace app\controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\Controllers\Controller;
use app\database\models\Categoria;
use app\middleware\PermissionMiddleware;


class CategoriaController extends Controller
{
    protected $categoria;
    protected string $viewFolder = 'categorias';
    protected int $moduloId = 3;
    protected string $modulo='categoria';

    public function __construct()
    {
        $this->categoria = new Categoria();
    }
    public function index()
    {
        PermissionMiddleware::check($this->moduloId, 'ver');
        $search = filter_input(INPUT_GET, "search", FILTER_SANITIZE_SPECIAL_CHARS);
        $itemPerpage = filter_input(INPUT_GET, "items", FILTER_SANITIZE_SPECIAL_CHARS) ?? 10;

        $filters = new Filters();
        if ($search) {
            $filters->where('nome', 'LIKE', $search, 'OR');
            $filters->where('slug', 'LIKE', $search);
        }

        $pagination = new Pagination();
        $pagination->setItemsPerPage($itemPerpage);

        $this->categoria->setFilters($filters);
        $this->categoria->setPagination($pagination);
        $categorias = $this->categoria->fetchAll();

        $this->view(
            "{$this->viewFolder}/index",
            [
                'title' => ucfirst($this->viewFolder),
                'categorias' => $categorias,
                'pagination' => $pagination,
                'moduloId' => $this->moduloId,
                'itemPerPage' => $itemPerpage
            ]
        );
    }
    public function create()
    {
        PermissionMiddleware::check($this->moduloId, 'adicionar');

        $this->view("{$this->viewFolder}/create", [
            'title' =>  ucfirst($this->viewFolder),
        ]);
    }

    public function edit($id)
    {
        PermissionMiddleware::check($this->moduloId, 'editar');

        $categoria = $this->categoria->findBy('id', $id[0]);

        echo $this->view("{$this->viewFolder}\edit", [
            'title' =>  ucfirst($this->viewFolder),
            'categoria' => $categoria
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
            'slug' => 'required',
            'descricao' => 'required'
        ], persistInputs: true);

        $inputs = $validate->getInputs();
        $id = $inputs['id'];

        if (!$validated) {
            return redirect($id > 0 ? "/{$this->modulo}/edit/{$id}" : "/{$this->modulo}/create", 'warning', 'Verifique os campos obrigatórios');
        }

        if ($id) {
            // Editar Módulo
            $result = $this->categoria->update('id', $id, $validated);
            return redirect(
                "/{$this->modulo}",
                $result ? 'success' : 'danger',
                $result ? 'Categoria atualizada com sucesso!' : 'Falha ao atualizar Categoria'
            );
        } else {
            // Cadastrar Módulo
            $result = $this->categoria->create($validated);
            return redirect(
                "/{$this->modulo}",
                $result ? 'success' : 'danger',
                $result ? 'Categoria Adicionada com sucesso!' : 'Falha ao adicionar Categoria'
            );
        }
    }

    public function delete($id)
    {
        PermissionMiddleware::check($this->moduloId, 'excluir');

        $result = $this->categoria->delete('id', $id[0]);
        return redirect(
            "/{$this->modulo}",
            $result ? 'success' : 'danger',
            $result ? 'Categoria Excluída com sucesso!' : 'Falha ao excluir Categoria'
        );

    }
    public function show($id)
    {
        PermissionMiddleware::check($this->moduloId, 'ver');

        $categoria = $this->categoria->findBy('id', $id);

        echo $this->view("/{$this->modulo}/show", ['categoria' => $categoria]);
    }
}
