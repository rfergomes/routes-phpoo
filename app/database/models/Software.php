<?php

namespace app\database\models;

class Software extends Model
{
    protected string $table = 'softwares';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_softwares';

}
