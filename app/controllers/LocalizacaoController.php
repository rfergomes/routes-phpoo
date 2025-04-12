<?php

namespace app\controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\Controllers\Controller;
use app\database\models\Localizacao;
use app\middleware\PermissionMiddleware;

class LocalizacaoController extends Controller
{
    protected  $localizacao;
    protected string $viewFolder = 'localizacoes';
    protected int $moduloId = 6;
    public function __construct()
    {
        $this->localizacao = new localizacao();
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

        $this->localizacao->setFilters($filters);
        $this->localizacao->setPagination($pagination);
        $localizacoes = $this->localizacao->fetchAll();

        $this->view(
            "{$this->viewFolder}/index",
            [
                'title' => ucfirst($this->viewFolder),
                'localizacoes' => $localizacoes,
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

        $localizacao = $this->localizacao->findBy('id', $id[0]);

        echo $this->view("{$this->viewFolder}/edit", [
            'title' =>  ucfirst($this->viewFolder),
            'localizacao' => $localizacao
        ]);
    }


    public function save()
    {
        PermissionMiddleware::check($this->moduloId, 'editar');
        PermissionMiddleware::check($this->moduloId, 'adicionar');
        $validate = new Validate();
        $validated = $validate->validate([
            'id' => 'optional',
            'nome'=> 'required',
            'descricao' => 'required'
        ], persistInputs: true);

        $inputs = $validate->getInputs();
        $id = $inputs['id'];

        if (!$validated) {
            return redirect($id > 0 ? "/localizacao/edit/{$id}" : "/localizacao/create", 'warning', 'Verifique os campos obrigatórios');
        }

        if ($id) {
            // Editar Módulo
            $result = $this->localizacao->update('id', $id, $validated);
            return redirect(
                '/localizacao',
                $result ? 'success' : 'danger',
                $result ? 'Localização atualizada com sucesso!' : 'Falha ao atualizar Localização'
            );
        } else {
            // Cadastrar Módulo
            $result = $this->localizacao->create($validated);
            return redirect(
                '/localizacao',
                $result ? 'success' : 'danger',
                $result ? 'Localização Adicionada com sucesso!' : 'Falha ao adicionar Localização'
            );
        }
    }

    public function delete($id)
    {
        PermissionMiddleware::check($this->moduloId, 'excluir');

        $result = $this->localizacao->delete('id', $id[0]);
        return redirect(
            '/localizacao',
            $result ? 'success' : 'danger',
            $result ? 'Localização Excluída com sucesso!' : 'Falha ao excluir Localização'
        );
    }

    public function show()
    {

        $this->view('localizacoes/show',[
            'title'=> $this->viewFolder,
        ]);
    }
}
