<?php

namespace app\database\models;

class Manutencao extends Model
{
    protected string $table = 'manutencao';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_manutencao';

}
