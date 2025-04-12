<?php

namespace app\database\models;

class Localizacao extends Model
{
    protected string $table = 'localizacoes';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_localizacoes';

}
