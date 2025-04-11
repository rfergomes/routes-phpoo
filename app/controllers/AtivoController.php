<?php

namespace app\controllers;

use app\Controllers\Controller;
use app\database\models\Ativo;
use app\middleware\PermissionMiddleware;

class AtivoController extends Controller
{
    protected $ativo;
    public function __construct()
    {
        $this->ativo = new Ativo();
    }
    public function index()
    {
        PermissionMiddleware::check(1, 'ver');

        $ativos = $this->ativo->fetchAll();

        $this->view('ativos/index', [
            'title' => 'Ativos',
            'ativos' => $ativos
        ]);
    }
        
    public function create()
    {
        PermissionMiddleware::check(1, 'criar');

        $this->view('ativos/create');
    }
    public function store()
    {
        PermissionMiddleware::check(1, 'criar');

        // Validate and store the ativo data
        // $this->ativo->store($data);

        redirect('/ativos');
    }
    public function edit($id)
    {
        PermissionMiddleware::check(1, 'editar');

        $ativo = $this->ativo->findBy('id', $id);

        echo $this->view('ativos/edit', ['ativo' => $ativo]);
    }
    public function update()
    {
        PermissionMiddleware::check(1, 'editar');

        // Validate and update the ativo data
        // $this->ativo->update($data);

        redirect('/ativos');
    }
    public function delete($id)
    {
        PermissionMiddleware::check(1, 'deletar');

        $this->ativo->delete('id', $id);

        redirect('/ativos');
    }
    public function show($id)
    {
        PermissionMiddleware::check(1, 'ver');

        $ativo = $this->ativo->findBy('id', $id);

        echo $this->view('ativos/show', ['ativo' => $ativo]);
    }
    
}