<?php

namespace app\controllers;

use app\Controllers\Controller;
use app\database\models\Fabricante;
use app\middleware\PermissionMiddleware;

class FabricanteController extends Controller
{
    protected  $fabricante;
    public function __construct()
    {
        $this->fabricante = new Fabricante();
    }
    public function index()
    {
       
        PermissionMiddleware::check(1, 'ver');

        $fabricantes = $this->fabricante->fetchAll();

        $this->view('fabricantes/index', [
            'title'=>'Fabricantes',
            'fabricantes' => $fabricantes
        ]);
    }

    public function create()
    {
       
         $this->view('fabricantes/create');
    }

    public function store()
    {
    

        redirect('/fabricantes');
    }

    public function edit($id)
    {
       
        $fabricante = $this->fabricante->findBy('id',$id);

        echo $this->view('fabricantes/edit', ['fabricante' => $fabricante]);
    }

    public function update()
    {
        

        redirect('/fabricantes');
    }

    public function delete($id)
    {

        $this->fabricante->delete('id',$id);

        redirect('/fabricantes');
    }
}
