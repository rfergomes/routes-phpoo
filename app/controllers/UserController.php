<?php

namespace app\controllers;

use app\core\Request;
use app\support\Csrf;
use app\support\Flash;
use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\database\models\User;
use app\controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        $filters = new Filters;
        $filters->where('users.id', '>', 0);
        $filters->join('user_groups', 'users.user_level', '=', 'user_groups.group_level', 'left join');

        $pagination = new Pagination;
        $pagination->setItemsPerPage(20);

        $user = new User;
        $user->setFields('users.id, name, username, group_name, image, status, last_login');
        $user->setFilters($filters);
        $user->setPagination($pagination);
        $usersFound = $user->fetchAll();
        $count = $user->count();

        $this->view(
            'user',
            [
                'title' => 'Lista de usuários',
                'users' => $usersFound,
                'count' => $count,
                'pagination' => $pagination,
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
        $user->setFields('users.id, name, username,password, user_level, group_name , image, status, last_login');
        $user->setFilters($filters);
        $usersFound = $user->fetchAll(); // Cast para evitar SQL Injection
        if (!$usersFound) {
            \redirect('404');
        }

        $this->view(
            'userForm',
            [
                'title' => 'Usuário/Alterar',
                'user' => $usersFound,
            ]
        );
    }


    public function update($params)
    {

        $validate = new Validate;
        $validated = $validate->validate([
            'id' => 'required',
            'username' => 'required',
            'name' => 'required',
            'email' => 'email|required|unique:' . User::class,
            'password' => 'maxLen:5|required',
        ]);
        var_dump($validate, $params);
        if (!$validated) {
            return redirect('/user/12');
        }

        var_dump($validated);
    }

    public function save()
    {

        $validate = new Validate;
        $validated = $validate->validate([
            'id' => 'required',
            'username' => 'required',
            'name' => 'required',
            'email' => 'email|required|unique:' . User::class,
            'password' => 'required|maxLen:5|minLen:3',
        ]);

        $inputs = $validate->getInputs(); // Método fictício para acessar inputsValidation
        $id = $inputs['id'];

        if (!$validated) {
            return redirect("/user/{$id}");
        }

        $user = new User();
        $updated = $user->update('id', $id, $validated);
        if ($updated) {
            Flash::set('success', "Usuário Alterado com sucesso");
            return redirect("/user");
        } else {
            Flash::set('danger', "Erro ao alterar usuário");
            return redirect("/user/{$id}");
        }
    }
}
