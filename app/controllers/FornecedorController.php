<?php

namespace app\controllers;

use app\Controllers\Controller;
use app\database\models\Fornecedor;
use app\middleware\PermissionMiddleware;

class FornecedorController extends Controller
{
    protected  $fornecedor;
    public function __construct()
    {
        $this->fornecedor = new Fornecedor();
    }
    public function index()
    {
       
        PermissionMiddleware::check(1, 'ver');

        $fornecedor = $this->fornecedor->fetchAll();

        $this->view('fornecedores/index', [
            'title'=>'Fornecedores',
            'fornecedores' => $fornecedor
        ]);
    }

    public function create()
    {
       
         $this->view('fornecedores/create');
    }

    public function store()
    {
    

        redirect('/fornecedores');
    }

    public function edit($id)
    {

        $fornecedor = $this->fornecedor->findBy('id',$id);

        echo $this->view('fornecedores/edit', ['fornecedor' => $fornecedor]);
    }

    public function update()
    {
        

        redirect('/fornecedores');
    }

    public function delete($id)
    {

        $this->fornecedor->delete('id',$id);

        redirect('/fornecedores');
    }
}
