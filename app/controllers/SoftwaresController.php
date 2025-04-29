<?php

namespace app\controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\Controllers\Controller;
use app\database\models\Software;
use app\middleware\PermissionMiddleware;

class SoftwaresController extends Controller
{
    protected $software;
    protected string $viewFolder = 'softwares';
    protected int $moduloId = 14;
    protected string $modulo='software';

    public function __construct()
    {
        $this->software = new software();
    }
    public function index()
    {
        PermissionMiddleware::check($this->moduloId, 'ver');
        $search = filter_input(INPUT_GET, "search", FILTER_SANITIZE_SPECIAL_CHARS);
        $itemPerpage = filter_input(INPUT_GET, "items", FILTER_SANITIZE_SPECIAL_CHARS) ?? 10;

        $filters = new Filters();
        if ($search) {
            $filters->where('nome', 'LIKE', $search);
        }

        $pagination = new Pagination();
        $pagination->setItemsPerPage($itemPerpage);

        $filters->orderBy('nome','ASC');
        $this->software->setFilters($filters);
        $this->software->setPagination($pagination);
        $softwares = $this->software->fetchAll();

        $this->view(
            "{$this->viewFolder}/index",
            [
                'title' => ucfirst($this->viewFolder),
                'softwares' => $softwares,
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

        $software = $this->software->findBy('id', $id[0]);

        echo $this->view("{$this->viewFolder}/edit", [
            'title' =>  ucfirst($this->modulo) . ' / Editar',
            'software' => $software
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
            $result = $this->software->update('id', $id, $validated);
            return redirect(
                "/{$this->modulo}",
                $result ? 'success' : 'danger',
                $result ? 'software atualizada com sucesso!' : 'Falha ao atualizar software'
            );
        } else {
            // Cadastrar Módulo
            $result = $this->software->create($validated);
            return redirect(
                "/{$this->modulo}",
                $result ? 'success' : 'danger',
                $result ? 'software Adicionada com sucesso!' : 'Falha ao adicionar software'
            );
        }
    }

    public function delete($id)
    {
        PermissionMiddleware::check($this->moduloId, 'excluir');

        $result = $this->software->delete('id', $id[0]);
        return redirect(
            "/{$this->modulo}",
            $result ? 'success' : 'danger',
            $result ? 'software Excluída com sucesso!' : 'Falha ao excluir software'
        );

    }
    public function show($id)
    {
        PermissionMiddleware::check($this->moduloId, 'ver');

        $software = $this->software->findBy('id', $id);

        echo $this->view("/{$this->modulo}/show", ['software' => $software]);
    }
}