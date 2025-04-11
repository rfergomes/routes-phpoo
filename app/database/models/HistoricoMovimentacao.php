<?php

namespace app\database\models;

class HistoricoMovimentacao extends Model
{
    protected string $table = 'historico_movimentacao';
    protected string $primaryKey = 'id';
    protected string $dateFormat = 'Y-m-d H:i:s';
    protected string $primaryKeyField = 'id';
    protected string $tableView = 'list_historico_movimentacao';

}
