<?php

namespace app\database;

use PDO;

class Connection
{
  private static $connection = null;

  public static function connect()
  {
    if (!self::$connection) {
      self::$connection = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']}", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
      ]);
    }

    return self::$connection;
  }
}
