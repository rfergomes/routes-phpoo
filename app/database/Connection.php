<?php

namespace app\database;

use PDO;

class Connection
{
  private static $connection = null;

  public static function connect()
  {
    if (!self::$connection) {
      self::$connection = new PDO("mysql:host=".env('DB_HOST').";dbname=".env('DB_DATABASE')."", env('DB_USERNAME'), env('DB_PASSWORD'), [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
      ]);
    }

    return self::$connection;
  }
}
