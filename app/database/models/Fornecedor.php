<?php

namespace app\database\models;

class Fornecedor extends Model
{
    protected string $table = 'fornecedores';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_fornecedor';

}
