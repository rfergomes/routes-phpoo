<?php

namespace app\controllers;

use app\database\Filters;
use app\support\Validate;
use app\database\Pagination;
use app\Controllers\Controller;
use app\database\models\Categoria;
use app\middleware\PermissionMiddleware;


class CategoriaController extends Controller
{
    protected $categoria;
    protected string $viewFolder = 'categorias';
    protected int $moduloId = 3;
    protected string $moduloName = 'categorias';

    public function __construct()
    {
        $this->categoria = new Categoria();
    }
    public function index()
    {
        PermissionMiddleware::check($this->moduloId, 'ver');
        $search = filter_input(INPUT_GET, "search", FILTER_SANITIZE_SPECIAL_CHARS);
        $itemPerpage = filter_input(INPUT_GET, "items", FILTER_SANITIZE_SPECIAL_CHARS);

        $filters = new Filters;
        if ($search) {
            $filters->where('descricao', 'LIKE', $search, 'or');
            $filters->where('nome', 'LIKE', $search);
        }

        //$filters->join('posts', 'users.id', '=', 'posts.user_id', 'left join');

        $pagination = new Pagination;
        $pagination->setItemsPerPage(20);

        $this->categoria->setFilters($filters);
        $this->categoria->setPagination($pagination);
        $categorias = $this->categoria->fetchAll();

        //var_dump($usersFound);
        //die();

        $this->view('/categorias/index', 
        [
            'title' => 'Home', 
            'categorias' => $categorias, 
            'pagination' => $pagination
        ]);
    }
    public function create()
    {
        PermissionMiddleware::check($this->moduloId, 'criar');

        $this->view('categorias/create');
    }
    public function store()
    {
        PermissionMiddleware::check(1, 'criar');

        $validate = new Validate;
        $validated = $validate->validate([
            'nome' => 'required|maxLen:100',
            'descricao' => 'optional',
        ]);

        if (!$validated) {
            redirect('/categorias/create', 'danger', 'Preencha os campos corretamente.');
        }

        $data['data_cad'] = date('Y-m-d H:i:s');

        $this->categoria->create($data);
        redirect('/categoria', 'success', 'Categoria cadastrada com sucesso!');
    }
    public function edit($id)
    {
        PermissionMiddleware::check($this->moduloId, 'editar');

        $categoria = $this->categoria->findBy('id', $id);

        echo $this->view('categorias/edit', ['categoria' => $categoria]);
    }
    public function update()
    {
        PermissionMiddleware::check(1, 'editar');

        // Validate and update the categoria data
        // $this->categoria->update($data);

        redirect('/categorias');
    }
    public function delete($id)
    {
        PermissionMiddleware::check($this->moduloId, 'deletar');

        $this->categoria->delete($id);

        redirect('/categorias');
    }
    public function show($id)
    {
        PermissionMiddleware::check($this->moduloId, 'ver');

        $categoria = $this->categoria->findBy('id', $id);

        echo $this->view('categorias/show', ['categoria' => $categoria]);
    }
}
