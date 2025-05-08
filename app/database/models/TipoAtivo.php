<?php

namespace app\database\models;

class TipoAtivo extends Model
{
    protected string $table = 'tipo_ativos';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_tipo_ativos';

}