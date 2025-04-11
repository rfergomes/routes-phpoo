<?php

namespace app\controllers;

use app\Controllers\Controller;
use app\database\models\Manutencao;
use app\middleware\PermissionMiddleware;

class ManutencaoController extends Controller
{
    protected $manutencao;
    public function __construct()   
    {
        $this->manutencao = new Manutencao();
    }
    public function index()
    {
        PermissionMiddleware::check(1,'ver');
        $manutencao = $this->manutencao->fetchall();
        $this->view('manutencao/index', [
            'manutencao' => $manutencao
        ]);   
    }
    public function create()
    {
        PermissionMiddleware::check(1,'criar');
        $this->view('manutencao/create');
    }
    public function store()
    {
        PermissionMiddleware::check(1,'criar');
        $data = $_POST;
        $this->manutencao->create($data);
        redirect('manutencao/index');
    }
    public function edit($id)
        {
        PermissionMiddleware::check(1,'editar');
        $manutencao = $this->manutencao->findby('id',$id);
        if ($manutencao) {
            $this->view('manutencao/edit', [
                'manutencao' => $manutencao
            ]);
        } else {
            redirect('manutencao/index');
        }

    }
    public function update($id)
    {
        PermissionMiddleware::check(1,'editar');
        $data = $_POST;
        $this->manutencao->update('id',$id, $data);
        redirect('manutencao/index');
    }
    public function delete($id)
    {
        PermissionMiddleware::check(1,'deletar');
        $manutencao = $this->manutencao->findby('id',$id);
        if ($manutencao) {
            $this->manutencao->delete($id);
            redirect('manutencao/index');
        } else {
           redirect('manutencao/index');
        }
    }
    public function show($id)
    {
        PermissionMiddleware::check(1,'ver');
        $manutencao = $this->manutencao->findby('id',$id);
        if ($manutencao) {
            $this->view('manutencao/show', [
                'manutencao' => $manutencao
            ]);
        } else {
            redirect('manutencao/index');
        }
    }
    
       
}