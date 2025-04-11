<?php

namespace app\database\models;

class Fabricante extends Model
{
    protected string $table = 'modulos';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_modulos';

}
