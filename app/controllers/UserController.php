<?php

namespace app\controllers;

use app\core\Request;
use app\support\Csrf;
use app\database\Filters;
use app\support\Validate;
use app\database\models\User;
use app\controllers\Controller;
use app\support\Flash;

class UserController extends Controller
{

    public function index()
    {
        $filters = new Filters;
        $filters->where('users.id', '>', 0);
        $filters->join('user_groups', 'users.user_level', '=', 'user_groups.group_level', 'left join');

        $user = new User;
        $user->setFields('users.id, name, username, group_name, image, status, last_login');
        $user->setFilters($filters);
        $usersFound = $user->fetchAll();
        $count = $user->count();

        $this->view(
            'user',
            [
                'title' => 'Lista de usuários',
                'users' => $usersFound,
                'count' => $count,
            ]
        );
    }

    public function create($params)
    {
        $this->view(
            'user',
            [
                'title' => 'Criar user',
            ]
        );
    }

    public function getById($params)
    {

        // Validando os parâmetros
        if (!is_array($params) || empty($params[0]) || !is_numeric($params[0])) {
            http_response_code(400);
            echo json_encode(['error' => 'ID inválido']);
            return;
        }

        $id = $params[0];
        $filters = new Filters();

        $filters->join('user_groups', 'users.user_level', '=', 'user_groups.group_level', 'left join');
        $filters->where('users.id', '=', $id);
        $filters->limit(1);

        $user = new User();
        $user->setFields('users.id, name, username,password, user_level, image, status, last_login');
        $user->setFilters($filters);
        $usersFound = $user->fetchAll(); // Cast para evitar SQL Injection
        if (!$usersFound) {
            http_response_code(404);
            echo json_encode(['error' => 'Usuário não encontrado']);
            return;
        }

        echo json_encode($usersFound[0]);
    }

    public function userForm($params)
    {
        // Validando os parâmetros
        if (!is_array($params) || empty($params[0]) || !is_numeric($params[0])) {
            \redirect('404');
        }

        $id = $params[0];
        $filters = new Filters();

        $filters->join('user_groups', 'users.user_level', '=', 'user_groups.group_level', 'left join');
        $filters->where('users.id', '=', $id);
        $filters->limit(1);

        $user = new User();
        $user->setFields('users.id, name, username,password, user_level, image, status, last_login');
        $user->setFilters($filters);
        $usersFound = $user->fetchAll(); // Cast para evitar SQL Injection
        if (!$usersFound) {
            \redirect('404');
        }

        $this->view(
            'user',
            [
                'title' => 'Criar user',
                'user'=>$usersFound,
            ]
        );
    }


    public function update($params)
    {

        $validate = new Validate;
        $validated = $validate->validate([
            'name' => 'required',
            'email' => 'email|required|unique:' . User::class,
            'password' => 'maxLen:5|required',
        ]);
        \var_dump($validate);
        die();
        if (!$validated) {
            return redirect('/user/12');
        }

        \var_dump($validated);
    }

    public function save()
    {
        $resultado = ['success'=>'Alterado'];
        $validate = new Validate;
        $validated = $validate->validate([
            'name' => 'required',
            'email' => 'email|required|unique:' . User::class,
            'password' => 'maxLen:5|required',
        ]);

        if (!$validated) {
            $resultado=['error'=>$_SESSION['flash']];
        }

        echo \json_encode($resultado);
    }
}
