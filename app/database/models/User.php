<?php
namespace app\database\models;

use app\database\Connection;

class User extends Model
{
    protected string $table = 'users';
    protected string $tableView = 'list_users';


}
