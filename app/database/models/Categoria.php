<?php

namespace app\database\models;

class Categoria extends Model
{
    protected string $table = 'categorias';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_categorias';

}
