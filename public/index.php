<?php

use app\core\Router;
use Dotenv\Dotenv;
use app\core\Session;

require '../vendor/autoload.php';

Session::start();


$dotenv = Dotenv::createImmutable('../');
$dotenv->load();
$router = new Router();
Router::run();
