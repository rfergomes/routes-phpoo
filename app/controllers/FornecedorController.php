<?php

namespace app\controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\Controllers\Controller;
use app\database\models\Fornecedor;
use app\middleware\PermissionMiddleware;

class FornecedorController extends Controller
{
    protected  $fornecedor;
    protected string $viewFolder = 'fornecedores';
    protected int $moduloId = 6;
    public function __construct()
    {
        $this->fornecedor = new Fornecedor();
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

        $this->fornecedor->setFilters($filters);
        $this->fornecedor->setPagination($pagination);
        $fornecedores = $this->fornecedor->fetchAll();

        $this->view(
            "{$this->viewFolder}/index",
            [
                'title' => ucfirst($this->viewFolder),
                'fornecedores' => $fornecedores,
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

        $fornecedor = $this->fornecedor->findBy('id', $id[0]);

        echo $this->view("{$this->viewFolder}/edit", [
            'title' =>  ucfirst($this->viewFolder),
            'fornecedor' => $fornecedor
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
            'cnpj' => 'required|unique:'.Fornecedor::class,
            'telefone' => 'required',
            'email' => 'required',
            'endereco' => 'required'
        ], persistInputs: true);

        $inputs = $validate->getInputs();
        $id = $inputs['id'];

        if (!$validated) {
            return redirect($id > 0 ? "/fornecedor/edit/{$id}" : "/fornecedor/create", 'warning', 'Verifique os campos obrigatórios');
        }

        if ($id) {
            // Editar Módulo
            $result = $this->fornecedor->update('id', $id, $validated);
            return redirect(
                '/fornecedor',
                $result ? 'success' : 'danger',
                $result ? 'Fornecedor atualizada com sucesso!' : 'Falha ao atualizar Fornecedor'
            );
        } else {
            // Cadastrar Módulo
            $result = $this->fornecedor->create($validated);
            return redirect(
                '/fornecedor',
                $result ? 'success' : 'danger',
                $result ? 'Fornecedor Adicionada com sucesso!' : 'Falha ao adicionar Fornecedor'
            );
        }
    }

    public function delete($id)
    {
        PermissionMiddleware::check($this->moduloId, 'excluir');

        $result = $this->fornecedor->delete('id', $id[0]);
        return redirect(
            '/fornecedor',
            $result ? 'success' : 'danger',
            $result ? 'Fornecedor Excluída com sucesso!' : 'Falha ao excluir Fornecedor'
        );
    }

    public function show()
    {

        $this->view('fornecedores/show',[
            'title'=> $this->viewFolder,
        ]);
    }
}
