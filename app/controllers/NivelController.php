<?php

namespace app\controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\database\models\Nivel;
use app\Controllers\Controller;
use app\database\models\Modulo;
use app\database\models\Permission;
use app\middleware\PermissionMiddleware;

class NivelController extends Controller
{
    protected  $nivel;
    protected string $viewFolder = 'niveis';
    protected int $moduloId = 17;
    public function __construct()
    {
        $this->nivel = new Nivel();
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

        $this->nivel->setFilters($filters);
        $this->nivel->setPagination($pagination);
        $niveis = $this->nivel->fetchAll();

        $this->view(
            "{$this->viewFolder}/index",
            [
                'title' => ucfirst($this->viewFolder),
                'niveis' => $niveis,
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
            'title' => ucfirst($this->viewFolder),
            'moduloId' => $this->moduloId,
        ]);
    }


    public function edit($id)
    {
        PermissionMiddleware::check($this->moduloId, 'editar');

        $nivel = $this->nivel->findBy('id', $id[0]);

        echo $this->view("{$this->viewFolder}/edit", [
            'title' =>  ucfirst($this->viewFolder),
            'nivel' => $nivel
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
            'descricao' => 'required'
        ], persistInputs: true);

        $inputs = $validate->getInputs();
        $id = $inputs['id'];

        if (!$validated) {
            return redirect($id > 0 ? "/nivel/edit/{$id}" : "/nivel/create", 'warning', 'Verifique os campos obrigatórios');
        }

        if ($id) {
            // Editar Módulo
            $result = $this->nivel->update('id', $id, $validated);
            return redirect(
                '/nivel',
                $result ? 'success' : 'danger',
                $result ? 'Nivel atualizado com sucesso!' : 'Falha ao atualizar Nivel'
            );
        } else {
            // Cadastrar Módulo
            $result_id = $this->nivel->create($validated);
            if ($result_id) {
                $modulo = new Modulo();
                $modulos=$modulo->fetchAll();

                $permissao = new Permission();

                foreach ($modulos as $modulo) {
                    $permissao->create([
                        'nivel_id' => $result_id,
                        'modulo_id' => $modulo->id,
                        'pode_ver' => 0,
                        'pode_editar' => 0,
                        'pode_adicionar' => 0,
                        'pode_excluir' => 0
                    ]);

                }
            }
            return redirect(
                '/nivel',
                $result_id ? 'success' : 'danger',
                $result_id ? 'Nivel Adicionado com sucesso!' : 'Falha ao adicionar Nivel'
            );
        }
    }

    public function delete($id)
    {
        PermissionMiddleware::check($this->moduloId, 'excluir');

        $result = $this->nivel->delete('id', $id[0]);
        return redirect(
            '/nivel',
            $result ? 'success' : 'danger',
            $result ? 'Nivel Excluída com sucesso!' : 'Falha ao excluir Nivel'
        );
    }

    public function show()
    {

        $this->view("{$this->viewFolder}/show", [
            'title' => $this->viewFolder,
        ]);
    }
}