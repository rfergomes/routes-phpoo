<?php

namespace app\database\models;

class Nivel extends Model
{
    protected string $table = 'niveis';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_niveis';

}
