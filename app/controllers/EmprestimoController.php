<?php

namespace app\controllers;

use app\Controllers\Controller;
use app\database\models\Emprestimo;
use app\middleware\PermissionMiddleware;

class EmprestimoController extends Controller
{
    protected $emprestimo;
    public function __construct()
    {
        $this->emprestimo = new Emprestimo();
    }
    public function index()
    {
        PermissionMiddleware::check(1, 'ver');
        $emprestimos = $this->emprestimo->fetchAll();
        return $this->view('emprestimo.index', [
            'emprestimos' => $emprestimos
        ]);
    }
    public function create()
    {
        PermissionMiddleware::check(1, 'criar');
        return $this->view('emprestimo.create');
    }
    public function store()
    {
        PermissionMiddleware::check(1, 'criar');
        $data = $_POST;
        $this->emprestimo->create($data);
        redirect('/emprestimos');
    }
    public function edit($id)
    {
        PermissionMiddleware::check(1, 'editar');
        $emprestimo = $this->emprestimo->findBy('id', $id);
        return $this->view('emprestimo.edit', [
            'emprestimo' => $emprestimo
        ]);
    }
    public function update($id)
    {
        PermissionMiddleware::check(1, 'editar');
        $data = $_POST;
        $this->emprestimo->update('id',$id, $data);
        redirect('/emprestimos');
    }
    public function delete($id)
    {
        PermissionMiddleware::check(1, 'deletar');
        $this->emprestimo->delete($id);
        redirect('/emprestimos');
    }
    public function show($id)
    {
        PermissionMiddleware::check(1, 'ver');
        $emprestimo = $this->emprestimo->findBy('id', $id);
        return $this->view('emprestimo.show', [
            'emprestimo' => $emprestimo
        ]);
    }
    
}