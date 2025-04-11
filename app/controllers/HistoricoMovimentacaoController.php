<?php

namespace app\controllers;

use app\Controllers\Controller;
use app\database\models\HistoricoMovimentacao;
use app\middleware\PermissionMiddleware;
class HistoricoMovimentacaoController extends Controller
{
    protected $historico;
    public function __construct()
    {
        $this->historico = new HistoricoMovimentacao();
    }
    public function index()
    {
        PermissionMiddleware::check(1, 'ver');

        $historico = $this->historico->fetchAll();

        $this->view('historico/index', [
            'title'=>'Historico de Movimentação',
            'historicos' => $historico
        ]);
    }
        public function create()
    {
        $this->view('historico/create');
    }
    public function store()
    {
        redirect('/historico');
    }       
    public function edit($id)
    {
        $historico = $this->historico->findBy('id',$id);

        echo $this->view('historico/edit', ['historico' => $historico]);
    }
    public function update()
    {
        redirect('/historico');
    }
    public function delete($id)
    {
        $this->historico->delete('id',$id);
        redirect('/historico');
    }
        public function show($id)
    {
        $historico = $this->historico->findBy('id',$id);

        echo $this->view('historico/show', ['historico' => $historico]);
    }
    
}