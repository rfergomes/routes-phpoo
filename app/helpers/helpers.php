<?php

use app\support\Uri;

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
    echo '</pre></div>';
    die();
}

function breadcrumb(): array
{
    $uri = trim(Uri::get(), '/');

    if (empty($uri)) return [];

    $segments = explode('/', $uri);
    $breadcrumbs = [];
    $path = '';

    // Mapeamento de nomes amigáveis
    $map = [
        'dashboard' => 'Painel',
        'usuarios'  => 'Usuários',
        'create'    => 'Novo',
        'edit'      => 'Editar',
        'show'      => 'Detalhes',
        'config'    => 'Configurações',
    ];

    foreach ($segments as $segment) {
        // Ignora IDs numéricos
        if (is_numeric($segment)) continue;

        $path .= '/' . $segment;

        $label = $map[$segment] ?? ucfirst(str_replace(['-', '_'], ' ', $segment));

        $breadcrumbs[] = [
            'label' => $label,
            'url' => $path
        ];
    }

    return $breadcrumbs;
}

