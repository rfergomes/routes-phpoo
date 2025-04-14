<?php

namespace app\controllers;

use Exception;
use app\core\Session;
use app\support\Flash;
use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\controllers\Controller;
use app\database\models\Usuario;
use app\middleware\AuthMiddleware;
use app\database\models\Permission;

class AuthController extends Controller
{
    protected $usuario;
    protected string $viewFolder = 'auth';

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function login()
    {
        AuthMiddleware::onlyGuests();
        $this->view("{$this->viewFolder}/login", [
            'title' => 'Login'
        ]);
    }

    public function authenticate()
    {

        $validate = new Validate;

        $validated = $validate->validate([
            'email' => 'email|required',
            'senha' => 'required|maxLen:5|minLen:3',
        ], persistInputs: true);

        if (!$validated) {
            return redirect("/login");
        }

        $user= $this->usuario->findBy('email', $validated['email']);

        if (!$user || !password_verify($validated['senha'], $user->senha)) {
            flash::set('danger', 'Email ou senha inválidos');
            return redirect('/login');
        }
        unset($user->senha);

        $perm = new Permission();
        $permissions = $perm->getPermissionsByLevel($user->nivel_id);

        Session::set('permissions', $permissions);
        Session::set('user', $user);
        
        return redirect('/');
    }

    public function unauthorized()
    {
        return $this->view('auth/unauthorized');
    }

    public function logout()
    {
        Session::destroy();
        return redirect('/login');
    }
}
