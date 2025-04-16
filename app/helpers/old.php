<?php

use app\support\RequestType;

function setOld()
{
    $_SESSION['old'] = $_POST ?? [];
}

function getOld($key)
{
    

    if (isset($_SESSION['old'][$key])) {
        $old = $_SESSION['old'][$key];
        unset($_SESSION['old'][$key]);
        return $old ?? '';
    }

    return '';
}


