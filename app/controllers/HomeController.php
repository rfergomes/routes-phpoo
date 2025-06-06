<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\Usuario;
use app\database\Pagination;

class HomeController extends Controller
{
    
  public function index()
  {
    
     $filters = new Filters;
     $filters->where('id', '>', 0);
     //$filters->join('posts', 'users.id', '=', 'posts.user_id', 'left join');

     $pagination = new Pagination;
     $pagination->setItemsPerPage(20);

     $user = new usuario;

     $user->setFilters($filters);
     $user->setPagination($pagination);
     $usersFound = $user->fetchAll();

     //var_dump($usersFound);
     //die();

     $this->view('/home', ['title' => 'Home', 'users' => $usersFound, 'pagination' => $pagination]);
    //$this->view('home', ['title' => 'Home']);
  }
}
