<?php

namespace app\controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\Controllers\Controller;
use app\database\models\Equipamento;
use app\database\models\Fabricante;
use app\database\models\Fornecedor;
use app\middleware\PermissionMiddleware;

class EquipamentoController extends Controller
{
    protected $equipamento;
    protected $moduloName = 'equipamento';
    protected $moduloId = 19;
    protected $viewFolder = 'equipamentos';

    public function __construct()
    {
        $this->equipamento = new Equipamento();
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

        $this->equipamento->setFilters($filters);
        $this->equipamento->setPagination($pagination);

        $equipamentos = $this->equipamento->fetchAll();
        $count = $this->equipamento->count();

        $this->view("{$this->viewFolder}/index", [
            'title' => ucfirst($this->viewFolder),
            'moduloId' => $this->moduloId,
            'equipamentos' => $equipamentos,
            'pagination' => $pagination,
            'count' => $count,
            'itemPerPage' => $itemPerpage
        ]);
    }

    public function create()
    {
        PermissionMiddleware::check($this->moduloId, 'adicionar');

        $equipamento = new equipamento();
        $equipamentos = $equipamento->fetchAll();

        $fabricante = new Fabricante();
        $fabricantes = $fabricante->fetchAll();

        $fornecedor = new Fornecedor();
        $fornecedores = $fornecedor->fetchAll();

        $this->view("{$this->viewFolder}/create", [
            'title' => 'Criar equipamento',
            'equipamentos' => $equipamentos,
            'fabricantes'=>$fabricantes,
            'fornecedores' => $fornecedores
        ]);
    }

    public function edit($params)
    {

        PermissionMiddleware::check($this->moduloId, 'editar');
        if (!is_array($params) || empty($params[0]) || !is_numeric($params[0])) {
            return redirect("/404");
        }

        $id = $params[0];

        $equipamentos = $this->equipamento->findBy('id', $id);

        if (!$equipamentos) {
            return redirect("/404");
        }

        $filters = (new Filters())
        ->orderBy('nome','ASC');

        $fabricante = new Fabricante();
        $fabricante->setFilters($filters);
        $fabricantes = $fabricante->fetchAll();

        $fornecedor = new Fornecedor();
        $fornecedor->setFilters($filters);
        $fornecedores = $fornecedor->fetchAll();

        $this->view("{$this->viewFolder}/edit", [
            'title' => 'Editar equipamento',
            'moduloId' => $id,
            'equipamento' => $equipamentos,
            'fabricantes'=>$fabricantes,
            'fornecedores' => $fornecedores
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
            'modelo' => 'required',
            'numero_serie' => 'required',
            'service_tag' => 'optional',
            'observacao' => 'optional',
            'fornecedor_id' => 'required',
            'fabricante_id' => 'required',
            'situacao_id' => 'optional'
        ], persistInputs: true);

        $inputs = $validate->getInputs();
        $id = $inputs['id'];

        if (!$validated) {
            return redirect($id > 0 ? "/{$this->moduloName}/edit/{$id}" : "/{$this->moduloName}/create", 'warning', 'Verifique os campos obrigatórios');
        }
        $validated['situacao_id'] = $validated['situacao_id'] == 'true' ? 1:0;
        if ($id) {
            // Editar Módulo
            $result = $this->equipamento->update('id', $id, $validated);
            return redirect(
                "/{$this->moduloName}",
                $result ? 'success' : 'danger',
                $result ? 'equipamento atualizado com sucesso!' : 'Falha ao atualizar equipamento'
            );
        } else {
            // Cadastrar Módulo
            $result = $this->equipamento->create($validated);
            return redirect(
                "/{$this->moduloName}",
                $result ? 'success' : 'danger',
                $result ? 'equipamento Adicionado com sucesso!' : 'Falha ao adicionar equipamento'
            );
        }
    }

    public function delete($params)
    {
        PermissionMiddleware::check($this->moduloId, 'excluir');
        if (!is_array($params) || empty($params[0]) || !is_numeric($params[0])) {
            return redirect("/404");
        }

        $result = $this->equipamento->delete('id', $params[0]);
        return redirect(
            "/{$this->moduloName}",
            $result ? 'success' : 'danger',
            $result ? 'equipamento Adicionado com sucesso!' : 'Falha ao adicionar equipamento'
        );
    }
    
}