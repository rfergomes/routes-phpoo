<?php

namespace app\middleware;

use app\core\Session;
use app\database\models\Permission;

class PermissionMiddleware
{
    public static function check(int|string $moduloId, string $action)
    {

        // Verifica se o usuário está logado
        if (!Session::has('user')) {
            header('Location: /login');
            exit;
        }

        // Tenta obter permissões da sessão
        $permissions = Session::get('permissions', []);

        $perm = new Permission;

        // Verifica se o módulo e a ação são permitidos
        if (!$perm->hasPermissionInArray($permissions, $moduloId, $action)) {
            header('Location: /unauthorized');
            exit;
        }
    }
}
