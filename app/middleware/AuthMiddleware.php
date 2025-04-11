<?php
namespace app\middleware;

use app\core\Session;

class AuthMiddleware
{
    public static function handle()
    {
        if (!Session::has('user')) {
            header('Location: /login');
            exit;
        }
    }

    public static function onlyGuests()
    {
        if (Session::has('user')) {
            header('Location: /');
            exit;
        }
    }
}
