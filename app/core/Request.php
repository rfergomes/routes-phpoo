<?php

namespace app\core;

use Exception;

class Request
{
    public static function input(string $name)
    {
        // Verificar se os dados foram enviados como JSON
        $jsonInput = file_get_contents('php://input');
        $jsonData = json_decode($jsonInput, true);

        if (json_last_error() === JSON_ERROR_NONE && isset($jsonData[$name])) {
            return $jsonData[$name];
        }

        // Verificar se os dados foram enviados como dados de formulário padrão
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }

        throw new Exception("O índice {$name} não existe");
    }


    public static function all()
    {
        // Verificar se os dados foram enviados como JSON
        $jsonInput = file_get_contents('php://input');
        $jsonData = json_decode($jsonInput, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $jsonData;
        }

        // Se os dados não foram enviados como JSON, retornar os dados de formulário padrão
        return $_POST;
    }

    public static function only(string|array $only)
    {
        $fieldsPost = self::all();
        $arr = [];

        if (is_string($only)) {
            $only = [$only];
        }

        foreach ($only as $field) {
            if (isset($fieldsPost[$field])) {
                $arr[$field] = $fieldsPost[$field];
            }
        }

        return $arr;
    }

    public static function excepts(string|array $excepts)
    {
        $fieldsPost = self::all();

        if (is_array($excepts)) {
            foreach ($excepts as $index => $value) {
                unset($fieldsPost[$value]);
            }
        }

        if (is_string($excepts)) {
            unset($fieldsPost[$excepts]);
        }

        return $fieldsPost;
    }

    public static function query($name)
    {
        if (!isset($_GET[$name])) {
            throw new Exception("Não existe a query string {$name}");
        }
        return $_GET[$name];
    }

    public static function toJson(array $data)
    {
        return json_encode($data);
    }

    public static function toArray(string $data)
    {
        if (isJson($data)) {
            return json_decode($data);
        }
    }
}
