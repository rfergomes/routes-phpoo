<?php

namespace app\core;

class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Suporte a chaves aninhadas
    public static function set($key, $value = null): void
    {
        self::start();
        if (is_array($key) && is_array($value)) {
            foreach ($key as $k => $v) {
                $_SESSION[$k] = $v;
            }
        } elseif (is_array($key)) {
            // Ex: set(['user', 'nome'], 'João')
            self::setNested($_SESSION, $key, $value);
        } else {
            $_SESSION[$key] = $value;
        }
    }

    public static function get($key, $default = null)
    {
        self::start();
        if (is_array($key)) {
            return self::getNested($_SESSION, $key, $default);
        }
        return $_SESSION[$key] ?? $default;
    }

    public static function has($key): bool
    {
        self::start();
        if (is_array($key)) {
            return self::hasNested($_SESSION, $key);
        }
        return isset($_SESSION[$key]);
    }

    public static function remove($key): void
    {
        self::start();
        if (is_array($key)) {
            self::removeNested($_SESSION, $key);
        } else {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy(): void
    {
        self::start();
        $_SESSION = [];
        session_destroy();
    }

    // Métodos auxiliares
    private static function setNested(array &$array, array $keys, $value)
    {
        $ref = &$array;
        foreach ($keys as $key) {
            if (!isset($ref[$key]) || !is_array($ref[$key])) {
                $ref[$key] = [];
            }
            $ref = &$ref[$key];
        }
        $ref = $value;
    }

    private static function getNested(array $array, array $keys, $default)
    {
        foreach ($keys as $key) {
            if (!isset($array[$key])) {
                return $default;
            }
            $array = $array[$key];
        }
        return $array;
    }

    private static function hasNested(array $array, array $keys)
    {
        foreach ($keys as $key) {
            if (!isset($array[$key])) {
                return false;
            }
            $array = $array[$key];
        }
        return true;
    }

    private static function removeNested(array &$array, array $keys)
    {
        $ref = &$array;
        $lastKey = array_pop($keys);
        foreach ($keys as $key) {
            if (!isset($ref[$key]) || !is_array($ref[$key])) {
                return;
            }
            $ref = &$ref[$key];
        }
        unset($ref[$lastKey]);
    }
}


/*

// Criar sessão aninhada: $_SESSION['usuario']['nome'] = 'Maria';
Session::set(['usuario', 'nome'], 'Maria');

// Recuperar: $_SESSION['usuario']['nome']
$nome = Session::get(['usuario', 'nome']);

// Verificar existência
if (Session::has(['usuario', 'nome'])) {
    echo "Usuário definido!";
}

// Remover apenas a chave 'nome' dentro de 'usuario'
Session::remove(['usuario', 'nome']);

*/