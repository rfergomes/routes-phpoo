<?php


namespace app\controllers;

use app\database\Filters;
use app\database\models\Menu;
use app\support\Validate;
use app\database\Pagination;
use app\database\models\Nivel;
use app\Controllers\Controller;
use app\database\models\Modulo;
use app\database\models\Permission;
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
            ->join("menu", "menu.id", "=", "modulos.menu_id",'LEFT JOIN')
            ->where('modulos.nome', 'LIKE', $search);

        $pagination = new Pagination;
        $pagination->setItemsPerPage($itemPerpage ?? 10);

        $this->modulo->setFields('modulos.id, modulos.nome, modulos.descricao, modulos.icone, rota, menu.nome menu');
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
        $nivel = new Nivel();
        $niveis = $nivel->fetchAll();

        $menu = new Menu();
        $menus = $menu->fetchAll();

        $this->view("{$this->viewFolder}/create", [
            'title' => 'Criar Módulo',
            'niveis' => $niveis,
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

        $modulo = $this->modulo->findBy('id', $id);

        if (!$modulo) {
            return redirect("/404");
        }

        $nivel = new Nivel();
        $niveis = $nivel->fetchAll();

        $menu = new Menu();
        $menus = $menu->fetchAll();

        $this->view("{$this->viewFolder}/edit", [
            'title' => 'Editar Módulo',
            'moduloId' => $id,
            'modulo' => $modulo,
            'niveis' => $niveis,
            'menus' => $menus
        ]);
    }
    public function save()
    {

        $validate = new Validate;
        $validated = $validate->validate([
            'id' => 'optional',
            'nome' => 'required',
            'descricao' => 'required',
            'icone' => 'optional',
            'rota' => 'optional',
            'tipo_permissao' => 'required',
            'menu_id' => 'required'
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
            $result_id = $this->modulo->create($validated);
            if ($result_id) {

                $novoModulo = $this->modulo->findBy('id', $result_id);

                $nivel = new Nivel();
                $niveis = $nivel->fetchAll();
                $permissao = new Permission();

                $permissoesIniciais = [
                    1 => ['pode_ver' => 1, 'pode_editar' => 1, 'pode_adicionar' => 1, 'pode_excluir' => 1],
                    2 => ['pode_ver' => 1, 'pode_editar' => 0, 'pode_adicionar' => 0, 'pode_excluir' => 0],
                    3 => ['pode_ver' => 0, 'pode_editar' => 0, 'pode_adicionar' => 0, 'pode_excluir' => 0],
                ];

                foreach ($niveis as $nivel) {
                    if (isset($permissoesIniciais[$nivel->id])) {
                        $dados = array_merge([
                            'nivel_id' => $nivel->id,
                            'modulo_id' => $result_id,
                        ], $permissoesIniciais[$nivel->id]);
                        if ($nivel->id <= $novoModulo->tipo_permissao) {
                            $permissao->create($dados);
                        }
                    }
                }
            }
            return redirect(
                "/{$this->moduloName}",
                $result_id ? 'success' : 'danger',
                $result_id ? 'Módulo Adicionado com sucesso!' : 'Falha ao adicionar Módulo'
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
