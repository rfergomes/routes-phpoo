<?php
namespace app\support;

use app\core\Request;
use Exception;

class Csrf
{
    public static function getToken()
    {
        if (isset($_SESSION['token'])) {
            unset($_SESSION['token']);
        }

        $_SESSION['token'] = md5(uniqid());

        return "<input type='hidden' name='token' value='{$_SESSION['token']}'>";
    }


    public static function validateToken()
    {
        if (!isset($_SESSION['token'])) {
            return \json_encode(["error" => "Token inválido " . (isset($_SESSION['token']) ? $_SESSION['token'] : "Nenhum token foi passado")]);
        }

        $token = Request::only('token');

        //var_dump($token['token'], $_SESSION['token']);die();

        if (empty($token) || $_SESSION['token'] !== $token['token']) {
            return \json_encode(["error"=>"Token inválido {$_SESSION['token']} != {$token['token']}"]);
        }

        unset($_SESSION['token']);

        return true;
    }
}
