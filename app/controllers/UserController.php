<?php

namespace app\controllers;

use app\core\Request;
use app\support\Csrf;
use app\database\Filters;
use app\support\Validate;
use app\database\models\User;
use app\controllers\Controller;

class UserController extends Controller
{
    public function edit($params)
    {
        $filters = new Filters;
        $filters->where('users.id', '>', 0);
        $filters->join('user_groups', 'users.user_level', '=', 'user_groups.group_level', 'left join');

        $user = new User;
        $user->setFields('users.id, name, username, group_name, image, status, last_login');
        $user->setFilters($filters);
        $usersFound = $user->fetchAll();

        $this->view(
            'user',
            [
                'title' => 'Editar user',
                'users' => $usersFound,
            ]
        );
    }

    public function update($params)
    {
        // dd($params);
        $validate = new Validate;
        $validated = $validate->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'email|required|unique:' . User::class,
            'password' => 'maxLen:5|required',
        ]);

        if (!$validated) {
            return redirect('/user/12');
        }

        \var_dump($validated);
    }
}
