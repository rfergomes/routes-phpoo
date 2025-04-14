<?php


namespace app\controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\Controllers\Controller;
use app\database\models\Modulo;
use app\database\models\Permission;
use app\database\models\Usuario;
use app\middleware\PermissionMiddleware;

class ModuloController extends Controller
{
    protected $modulo;
    protected $moduloId = 12;
    protected string $moduloName = "modulo";
    protected $viewFolder = 'modulos';
    public function __construct()
    {
        $this->modulo = new Modulo();
    }
    public function index()
    {
        PermissionMiddleware::check($this->moduloId, 'ver');
        $search = filter_input(INPUT_GET, "search", FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $itemPerpage = filter_input(INPUT_GET, "items", FILTER_SANITIZE_SPECIAL_CHARS) ?? 10;

        $filters = (new Filters())
            ->where('nome', 'LIKE', $search);

        $pagination = new Pagination;
        $pagination->setItemsPerPage($itemPerpage ?? 10);

        $this->modulo->setFilters($filters);
        $this->modulo->setPagination($pagination);

        $modulos = $this->modulo->fetchAll();
        $count = $this->modulo->count();

        $this->view("{$this->viewFolder}/index", [
            'title' => ucfirst($this->viewFolder),
            'moduloId' => $this->moduloId,
            'modulos' => $modulos,
            'pagination' => $pagination,
            'count' => $count,
            'itemPerPage' => $itemPerpage
        ]);
    }
    public function create()
    {
        PermissionMiddleware::check($this->moduloId, 'adicionar');
        $this->view("{$this->viewFolder}/create", [
            'title' => 'Criar Módulo',
        ]);
    }
    public function edit($params)
    {

        PermissionMiddleware::check($this->moduloId, 'editar');
        if (!is_array($params) || empty($params[0]) || !is_numeric($params[0])) {
            return redirect("/404");
        }

        $id = $params[0];

        $modulo = $this->modulo->findBy('id', $id);

        if (!$modulo) {
            return redirect("/404");
        }

        $this->view("{$this->viewFolder}/edit", [
            'title' => 'Editar Módulo',
            'moduloId' => $id,
            'modulo' => $modulo
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
            'icone' => 'required',
            'rota' => 'required'
        ], persistInputs: true);

        $inputs = $validate->getInputs();
        $id = $inputs['id'];

        if (!$validated) {
            return redirect($id > 0 ? "/{$this->moduloName}/edit/{$id}" : "/{$this->moduloName}/create", 'warning', 'Verifique os campos obrigatórios');
        }

        if ($id) {
            // Editar Módulo
            $result = $this->modulo->update('id', $id, $validated);
            return redirect(
                "/{$this->moduloName}",
                $result ? 'success' : 'danger',
                $result ? 'Módulo atualizado com sucesso!' : 'Falha ao cadastrar Módulo'
            );
        } else {
            // Cadastrar Módulo
            $result = $this->modulo->create($validated);
            if ($result) {
                $permissao = new Permission();
                $permissao->create([
                    'nivel_id' => 1,
                    'modulo_id' => $result,
                    'pode_ver' => 1,
                    'pode_editar' => 1,
                    'pode_adicionar' => 1,
                    'pode_excluir' => 1,
                ]);
            }
            return redirect(
                "/{$this->moduloName}",
                $result ? 'success' : 'danger',
                $result ? 'Módulo Adicionado com sucesso!' : 'Falha ao adicionar Módulo'
            );
        }
    }

    public function delete($params)
    {
        PermissionMiddleware::check(1, 'excluir');
        if (!is_array($params) || empty($params[0]) || !is_numeric($params[0])) {
            return redirect("/404");
        }

        $result = $this->modulo->delete('id', $params[0]);
        return redirect(
            "/{$this->moduloName}",
            $result ? 'success' : 'danger',
            $result ? 'Módulo excluído com sucesso!' : 'Falha ao excluir o Módulo'
        );
    }
}
