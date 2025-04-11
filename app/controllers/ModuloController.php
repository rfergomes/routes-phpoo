<?php
    

namespace app\controllers;

use app\Controllers\Controller;
use app\database\models\Modulo;
use app\middleware\PermissionMiddleware;

class ModuloController extends Controller
{
    protected $modulo;
    public function __construct()
    {
        $this->modulo = new Modulo();
    }
    public function index()
    {
        PermissionMiddleware::check(1,'ver');
        $this->view('modulos/index', [
            'title' => 'Módulos',
        ]);
        
    }
    public function create()
    {
        PermissionMiddleware::check(1,'criar');
        $this->view('modulos/create', [
            'title' => 'Criar Módulo',
        ]);
    }
    public function edit($params)
    {
        PermissionMiddleware::check(1,'editar');
        $this->view('modulos/edit', [
            'title' => 'Editar Módulo',
        ]);
    }
    public function update($params)
    {
        $this->view('modulos/update', [
            'title' => 'Atualizar Módulo',
        ]);
    }
    public function delete($params)
    {
        PermissionMiddleware::check(1,'deletar');
        $this->view('modulos/delete', [
            'title' => 'Deletar Módulo',
        ]);
    }
}