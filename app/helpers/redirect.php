<?php

use app\support\flash;

function redirect(string $to, string $type = '', string $message = ''): never
{
    if ($type && $message) {
        flash::set($type, $message);
    }

    header("Location: {$to}");
    exit;
}


