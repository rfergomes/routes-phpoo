<?php

namespace app\support;

use app\traits\Validations;
use Exception;
/**
 * Class Validate
 *
 * This class provides validation support for various data inputs.
 * It includes methods to validate different types of data such as strings, numbers, emails, etc.
 *
 * @package App\Support
 */

class Validate
{
    use Validations;

    private $inputsValidation = [];

    public function getInputs()
    {
        return $this->inputsValidation;
    }

    private function getParam($validation, $param)
    {
        if (substr_count($validation, ':') === 1) {
            [$validation, $param] = explode(':', $validation);
        }

        return [$validation, $param];
    }

    private function validationExist($validation)
    {
        if (!method_exists($this, $validation)) {
            throw new Exception("O método {$validation} não existe na validação");
        }
    }

    public function validate(array $validationsFields, bool $persistInputs=false)
    {
        // $inputsValidation = [];
        foreach ($validationsFields as $field => $validation) {
            $havePipes = str_contains($validation, '|');

            if (!$havePipes) {
                $param = '';

                [$validation, $param] = $this->getParam($validation, $param);


                $this->validationExist($validation);

                // dd($methodValidation);
                $this->inputsValidation[$field] = $this->$validation($field, $param);

                // dd($methodValidation, $param);
            }

            if ($havePipes) {
                $validations = explode('|', $validation);
                $param = '';

                $this->multipleValidations($validations, $field, $param);
            }
        }

        if ($persistInputs) {
            setOld();
        }

        return $this->returnValidation();
    }

    private function multipleValidations($validations, $field, $param)
    {
        foreach ($validations as $validation) {
            [$validation, $param] = $this->getParam($validation, $param);

            $this->validationExist($validation);

            $this->inputsValidation[$field] = $this->$validation($field, $param);

            if ($this->inputsValidation[$field] === false || $this->inputsValidation[$field] === null) {
                // Se a validação falhar, armazena o erro e não continua com as outras validações
                // Se a validação falhar, não precisa continuar com as outras validações
                break;
            }
        }
    }

    private function returnValidation()
    {
        Csrf::validateToken();

        if (in_array(false, $this->inputsValidation, true)) {
            return null;
        }

        return $this->inputsValidation;
    }
}
