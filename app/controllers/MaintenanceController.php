<?php
namespace app\controllers;

class MaintenanceController extends Controller
{
    public function index()
    {
        $this->view('em_manutencao', ['title' => 'Site em Manutenção']);
    }
}
