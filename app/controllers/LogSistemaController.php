<?php

namespace app\controllers;

use app\Controllers\Controller;
use app\database\models\Log;
use app\middleware\PermissionMiddleware;

class LogSistemaController extends Controller
{
    protected $log;
    public function __construct()
    {
        $this->log = new Log();
    }
    public function index()
    {
        PermissionMiddleware::check(1,'ver');
        $logs = $this->log->fetchall();
        $this->view('logSistema/index', [
            'logs' => $logs
        ]);
        
    }
    public function show($id)
    {
        PermissionMiddleware::check(1,'ver');
        $log = $this->log->findby('id',$id);
        if ($log) {
            $this->view('logSistema/show', [
                'log' => $log
            ]);
        } else {
            redirect('logSistema/index');
        }
    }
    public function delete($id)
    {
        PermissionMiddleware::check(1,'deletar');
        $log = $this->log->findby('id',$id);
        if ($log) {
            $this->log->delete($id);
            redirect('logSistema/index');
        } else {
           redirect('logSistema/index');
        }
    }
    public function create()
    {
        PermissionMiddleware::check(1,'criar');
        $this->view('logSistema/create');
    }
    public function store()
    {
        PermissionMiddleware::check(1,'criar');
        $data = $_POST;
        $this->log->create($data);
        redirect('logSistema/index');
    }
    public function edit($id)
    {
        PermissionMiddleware::check(1,'editar');
        $log = $this->log->findby('id',$id);
        if ($log) {
            $this->view('logSistema/edit', [
                'log' => $log
            ]);
        } else {
            redirect('logSistema/index');
        }
    }
    public function update($id)
    {
        PermissionMiddleware::check(1,'editar');
        $data = $_POST;
        $this->log->update('id',$id, $data);
        redirect('logSistema/index');
    }
    
}