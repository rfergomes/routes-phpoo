<?php

use app\core\Session;
use app\database\models\Permission;

function auth(): ?object
{
    $user = Session::get('user');
    return is_object($user) ? $user : (object) $user;
}

function can($moduloId, $action)
{
    return (new Permission)->hasPermission(auth()->nivel_id, $moduloId, $action);
}