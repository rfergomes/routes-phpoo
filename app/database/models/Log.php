<?php

namespace app\database\models;

class Log extends Model
{
    protected string $table = 'Logsistema';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_logsistema';

}
