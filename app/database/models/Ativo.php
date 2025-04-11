<?php

namespace app\database\models;

class Ativo extends Model
{
    protected string $table = 'ativos';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_ativos';

}
