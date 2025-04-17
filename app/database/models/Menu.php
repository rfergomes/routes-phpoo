<?php

namespace app\database\models;

class Menu extends Model
{
    protected string $table = 'menu';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_menu';

}
