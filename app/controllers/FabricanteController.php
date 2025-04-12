<?php

namespace app\controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\Controllers\Controller;
use app\database\models\Fabricante;
use app\middleware\PermissionMiddleware;

class FabricanteController extends Controller
{
    protected $fabricante;
    protected string $viewFolder = 'fabricantes';
    protected int $moduloId = 5;

    public function __construct()
    {
        $this->fabricante = new Fabricante();
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

        $this->fabricante->setFilters($filters);
        $this->fabricante->setPagination($pagination);
        $fabricantes = $this->fabricante->fetchAll();

        $this->view(
            '/fabricantes/index',
            [
                'title' => ucfirst($this->viewFolder),
                'fabricantes' => $fabricantes,
                'pagination' => $pagination,
                'moduloId' => $this->moduloId,
                'itemPerPage' => $itemPerpage
            ]
        );
    }

    public function create()
    {
       PermissionMiddleware::check($this->moduloId,'adicionar');

         $this->view("{$this->viewFolder}/create",[
            'title'=> ucfirst($this->viewFolder),
            'moduloId'=> $this->moduloId,
         ]);
    }


    public function edit($id)
    {
        PermissionMiddleware::check($this->moduloId, 'editar');

        $fabricante = $this->fabricante->findBy('id', $id[0]);

        echo $this->view("{$this->viewFolder}/edit", [
            'title' =>  ucfirst($this->viewFolder),
            'fabricante' => $fabricante
        ]);
    }


    public function save()
    {
        PermissionMiddleware::check($this->moduloId, 'editar');
        PermissionMiddleware::check($this->moduloId, 'adicionar');
        $validate = new Validate();
        $validated = $validate->validate([
            'id' => 'optional',
            'nome' => 'required',
            'site' => 'required',
            'contato' => 'required'
        ], persistInputs: true);

        $inputs = $validate->getInputs();
        $id = $inputs['id'];

        if (!$validated) {
            return redirect($id > 0 ? "/fabricante/edit/{$id}" : "/fabricante/create", 'warning', 'Verifique os campos obrigatórios');
        }

        if ($id) {
            // Editar Módulo
            $result = $this->fabricante->update('id', $id, $validated);
            return redirect(
                '/fabricante',
                $result ? 'success' : 'danger',
                $result ? 'Fabricante atualizada com sucesso!' : 'Falha ao atualizar Fabricante'
            );
        } else {
            // Cadastrar Módulo
            $result = $this->fabricante->create($validated);
            return redirect(
                '/fabricante',
                $result ? 'success' : 'danger',
                $result ? 'Fabricante Adicionada com sucesso!' : 'Falha ao adicionar fabricante'
            );
        }
    }

    public function delete($id)
    {
        PermissionMiddleware::check($this->moduloId, 'excluir');

        $result = $this->fabricante->delete('id', $id[0]);
        return redirect(
            '/fabricante',
            $result ? 'success' : 'danger',
            $result ? 'Fabricante Excluída com sucesso!' : 'Falha ao excluir Fabricante'
        );

    }
}