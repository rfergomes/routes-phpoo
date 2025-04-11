<?php

namespace app\controllers;

use app\Controllers\Controller;
use app\database\models\Software;
use app\middleware\PermissionMiddleware;

class SoftwaresController extends Controller
{
    protected $sofware;
    public function __construct(){
        $this->sofware = new Software();
    }
    public function index(){
        PermissionMiddleware::check(1, 'ver');
        $software = $this->sofware->fetchall();
        $this->view('software/index', [
            'title' => 'Softwares',
         ]);

        }
        public function create(){
            PermissionMiddleware::check(1, 'criar');
            $this->view('software/create', [
                'title' => 'Criar Software',
             ]);
        }
        public function edit($params){
            PermissionMiddleware::check(1, 'editar');
            $this->view('software/edit', [
                'title' => 'Editar Software',
             ]);
        }
        public function update($params){
            $this->view('software/update', [
                'title' => 'Atualizar Software',
             ]);
        }
        public function delete($params){
            PermissionMiddleware::check(1, 'deletar');
            $this->view('software/delete', [
                'title' => 'Deletar Software',
             ]);
        }
        public function show($params){
            PermissionMiddleware::check(1, 'ver');
            $this->view('software/show', [
                'title' => 'Ver Software',
             ]);
        }
}