<?php

namespace app\database\models;

class Equipamento extends Model
{
    protected string $table = 'equipamentos';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_equipamentos';

}
