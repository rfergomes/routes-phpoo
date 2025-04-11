<?php


namespace app\controllers;

use app\Controllers\Controller;
use app\database\models\Modulo;
use app\middleware\PermissionMiddleware;

class ModuloController extends Controller
{
    protected $modulo;
    protected $moduloId = 13;
    protected $viewFolder = 'modulos';
    public function __construct()
    {
        $this->modulo = new Modulo();
    }
    public function index()
    {
        PermissionMiddleware::check($this->moduloId, 'ver');
        $this->view('modulos/index', [
            'title' => 'Módulos',
        ]);
    }
    public function create()
    {
        PermissionMiddleware::check($this->moduloId, 'criar');
        $this->view('modulos/create', [
            'title' => 'Criar Módulo',
        ]);
    }
    public function edit($params)
    {
        PermissionMiddleware::check($this->moduloId, 'editar');
        $this->view('modulos/edit', [
            'title' => 'Editar Módulo',
        ]);
    }
    public function save($params)
    {
        $this->view('modulos/update', [
            'title' => 'Atualizar Módulo',
        ]);
    }
    public function delete($params)
    {
        PermissionMiddleware::check($this->moduloId, 'deletar');
        $this->view('modulos/delete', [
            'title' => 'Deletar Módulo',
        ]);
    }
}
