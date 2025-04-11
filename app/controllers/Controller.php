<?php

namespace app\controllers;

use Exception;
use League\Plates\Engine;
use app\database\models\Model;

abstract class Controller
{
    protected Engine $templates;
    protected string $pathView;


    protected function view(string $view, array $data = [])
    {
        $viewPath = "../app/views/".$view.'.php';

        if (!file_exists($viewPath)) {
            throw new Exception("A view {$view} não existe");
        }

        $templates = new Engine('../app/views');
        
        echo $templates->render($view, $data);
    }
}
