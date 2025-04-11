<?php

function arrayIsAssociative(array $arr)
{
    return array_keys($arr) !== range(0, count($arr) - 1);
}

function isAjax()
{
    return isset($_SERVER["HTTP_HTTP_X_REQUEST_WITH"]) && $_SERVER["HTTP_HTTP_X_REQUEST_WITH"] == 'XMLHttpRequest';
}

function dd($data)
{
    if ($_ENV['APP_PRODUCTION'] === 'true') {
        echo '<p class="alert alert-danger" role="alert">';
        echo "Algo de errado não está certo!.";
        echo '</p>';
        die();
    }
    echo '<div class="alert alert-dark" role="alert">';
    echo '<strong>Debug:</strong> <br>';
    echo '<pre>';
    print_r($data);
    echo'</pre></div>';
    die();
}
