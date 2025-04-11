<?php

namespace app\database\models;

class Emprestimo extends Model
{
    protected string $table = 'emprestimos';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_emprestimos';

}
