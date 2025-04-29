<?php

namespace app\controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\Controllers\Controller;
use app\database\models\Ativo;
use app\middleware\PermissionMiddleware;

class AtivoController extends Controller
{
    protected $ativo;
    protected string $viewFolder = 'ativos';
    protected int $moduloId = 1;
    protected string $modulo='ativo';

    public function __construct()
    {
        $this->ativo = new Ativo();
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

        $this->ativo->setFilters($filters);
        $this->ativo->setPagination($pagination);
        $ativos = $this->ativo->fetchAll();

        $this->view(
            "{$this->viewFolder}/index",
            [
                'title' => ucfirst($this->viewFolder),
                'ativos' => $ativos,
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
        $ativo = $this->ativo->findBy('id', $id[0]);

        echo $this->view("{$this->viewFolder}/edit", [
            'title' =>  ucfirst($this->viewFolder),
            'ativo' => $ativo
        ]);
    }

    public function save(){
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
            $result = $this->ativo->update('id', $id, $validated);
            return redirect(
                "/{$this->modulo}",
                $result ? 'success' : 'danger',
                $result ? 'Ativo atualizada com sucesso!' : 'Falha ao atualizar Ativo'
            );
        } else {
            // Cadastrar Módulo
            $result = $this->ativo->create($validated);
            return redirect(
                "/{$this->modulo}",
                $result ? 'success' : 'danger',
                $result ? 'Ativo Adicionada com sucesso!' : 'Falha ao adicionar Ativo'
            );
        
        }
    }
    
    public function delete($id)
    {
        PermissionMiddleware::check($this->moduloId, 'excluir');

        $result = $this->ativo->delete('id', $id[0]);
        return redirect(
            "/{$this->modulo}",
            $result ? 'success' : 'danger',
            $result ? 'Ativo Excluída com sucesso!' : 'Falha ao excluir Ativo'
        );
    }
    public function show($id)
    {
        PermissionMiddleware::check($this->moduloId, 'ver');

        $ativo = $this->ativo->findBy('id', $id);

        echo $this->view('ativos/show', ['ativo' => $ativo]);
    }
    
}