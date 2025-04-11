<?php

namespace app\controllers;

use app\Controllers\Controller;
use app\database\models\Transferencia;
use app\middleware\PermissionMiddleware;

class TransferenciaController extends Controller
{
    protected $transferencia;
    public function __construct()
    {
        $this->transferencia = new Transferencia();
    }
    public function index()
    {
        PermissionMiddleware::check(1, 'ver');
        $this->view('transferencias/index', [
            'title' => 'Transferências',
        ]);
    }
    public function create()
    {
        PermissionMiddleware::check(1, 'criar');
        $this->view('transferencias/create', [
            'title' => 'Criar Transferência',
        ]);
    }
    public function edit($params)
    {
        PermissionMiddleware::check(1, 'editar');
        $this->view('transferencias/edit', [
            'title' => 'Editar Transferência',
        ]);
    }
    public function update($params)
    {
        $this->view('transferencias/update', [
            'title' => 'Atualizar Transferência',
        ]);
    }
    public function delete($params)
    {
        PermissionMiddleware::check(1, 'deletar');
        $this->view('transferencias/delete', [
            'title' => 'Deletar Transferência',
        ]);
    }
    public function show($params)
    {
        PermissionMiddleware::check(1, 'ver');
        $this->view('transferencias/show', [
            'title' => 'Ver Transferência',
        ]);
    }
}