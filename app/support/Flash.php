<?php
namespace app\support;

class Flash
{
    public static function set(string $index, string $value)
    {
        if (!isset($_SESSION['flash'][$index])) {
            $_SESSION['flash'][$index] = $value;
        }
    }

    public static function get(string $index)
    {
        if (isset($_SESSION['flash'][$index])) {
            $value = $_SESSION['flash'][$index];
            unset($_SESSION['flash'][$index]);

            return $value;
        }
    }
}
