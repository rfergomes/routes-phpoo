<?php

namespace app\database\models;

class Responsavel extends Model
{
    protected string $table = 'responsaveis';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_responsaveis';

}