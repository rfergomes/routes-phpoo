<?php

use app\support\Uri;
use app\database\Filters;
use app\database\models\Menu;
use app\database\models\Modulo;


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


function getModulosPermitidos($nivel_id)
{
    $filters = (new Filters())
        ->join('permissions', 'permissions.modulo_id', '=', 'modulos.id')
        ->where('permissions.nivel_id', '=', $nivel_id, 'AND')
        ->where('permissions.pode_ver', '=', '1','AND')
        ->where('modulos.menu_id','>', 1)
        ->orderBy('modulos.nome', 'ASC');

    $moduloModel = new Modulo();
    $moduloModel->setFields('modulos.id, modulos.nome, modulos.rota, modulos.icone, modulos.menu_id');
    $moduloModel->setFilters($filters);
    $modulos = $moduloModel->fetchAll();

    $menuModel = new Menu();
    $menus = $menuModel->fetchAll();

    // Organizar os módulos dentro dos seus respectivos menus
    $resultado = [];
    foreach ($menus as $menu) {
        $menu->modulos = [];
        foreach ($modulos as $modulo) {
            if ($modulo->menu_id == $menu->id) {
                $menu->modulos[] = $modulo;
            }
        }

        // Só adiciona menu se tiver ao menos um módulo permitido
        if (!empty($menu->modulos)) {
            $resultado[] = $menu;
        }
    }

    return $resultado;
}
