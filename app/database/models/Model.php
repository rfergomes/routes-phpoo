<?php

namespace app\database\models;

use app\database\Connection;
use app\database\Filters;
use app\database\Pagination;
use PDO;
use PDOException;

abstract class Model
{
  private string $fields = '*';
  private ?Filters $filters = null;
  private string $pagination = '';
  protected string $table;

  public function setFields($fields)
  {
    $this->fields = $fields;
  }

  public function setFilters(Filters $filters)
  {
    $this->filters = $filters;
  }

  public function setPagination(Pagination $pagination)
  {
    $pagination->setTotalItems($this->count());
    $this->pagination = $pagination->dump();
  }

  public function create(array $data)
  {
    try {
      $sql = "INSERT INTO {$this->table} (";
      $sql .= implode(',', array_keys($data)) . ") VALUES(";
      $sql .= ':' . implode(',:', array_keys($data)) . ")";

      $connect = Connection::connect();
      $prepare = $connect->prepare($sql);

      if ($prepare->execute($data)) {
        return $connect->lastInsertId(); // Retorna o ID gerado
      }

      return false; // Caso não insira nada
    } catch (PDOException $e) {
      var_dump($e->getMessage());
      return false;
    }
  }



  // $user->update('id', 22,['firstName' => 'alexa'])

  // update users set firstName = 'Mario', lastName = 'Santos' where id = 22

  public function update(string $field, string|int $fieldValue, array $data)
  {
    try {
      $sql = "UPDATE {$this->table} SET ";
      foreach ($data as $key => $value) {
        $sql .= "{$key} = :{$key},";
      }

      $sql = rtrim($sql, ',');

      $sql .= " WHERE {$field} = :{$field}";

      $connection = Connection::connect();

      $data[$field] = $fieldValue;

      $prepare = $connection->prepare($sql);

      return $prepare->execute($data);
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  public function fetchAll()
  {
    try {
      $sql = "SELECT {$this->fields} FROM {$this->table} {$this->filters?->dump()} {$this->pagination}";

      $connection = Connection::connect();

      $prepare = $connection->prepare($sql);

      $prepare->execute($this->filters ? $this->filters->getBind() : []);

      return $prepare->fetchAll(PDO::FETCH_CLASS);
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  public function findBy(array|string $field, string $value = '')
{
    try {
        $sql = "SELECT {$this->fields} FROM {$this->table}";

        $bind = [];

        // Se for array: monta a cláusula WHERE com múltiplos campos
        if (is_array($field)) {
            $conditions = [];
            foreach ($field as $f => $v) {
                $conditions[] = "{$f} = :{$f}";
                $bind[$f] = $v;
            }
            $sql .= " WHERE " . implode(" AND ", $conditions);
        } else {
            // Caso contrário, trata como string + value simples
            $sql .= " WHERE {$field} = :{$field}";
            $bind[$field] = $value;
        }

        // Se houver filtros externos (como WHEREs adicionais)
        if (!empty($this->filters)) {
            $sql .= ' ' . $this->filters->dump();
            $bind = array_merge($bind, $this->filters->getBind());
        }

        $connection = Connection::connect();
        $prepare = $connection->prepare($sql);
        $prepare->execute($bind);

        return $prepare->fetchObject();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
        return null;
    }
}

  public function first($field = 'id', $order = 'asc')
  {
    try {
      $sql = "SELECT {$this->fields} FROM {$this->table} ORDER BY {$field} {$order} LIMIT 1";

      $connection = Connection::connect();

      $query = $connection->query($sql);

      return $query->fetchObject();
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  public function delete(string $field = '', string|int $value = '')
  {
    try {
      $sql = (!empty($this->filters)) ?
        "delete from {$this->table} {$this->filters}" :
        "delete from {$this->table} where {$field} = :{$field}";

      $connection = Connection::connect();

      $prepare = $connection->prepare($sql);

      return $prepare->execute(empty($this->filters) ? [$field => $value] : $this->filters->getBind());
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }

  public function deleteWhere(array $conditions): bool
  {
    try {
      $whereClauses = [];
      foreach ($conditions as $key => $value) {
        $whereClauses[] = "{$key} = :{$key}";
      }

      $sql = "DELETE FROM {$this->table} WHERE " . implode(' AND ', $whereClauses);

      $connection = Connection::connect();
      $prepare = $connection->prepare($sql);

      return $prepare->execute($conditions);
    } catch (PDOException $e) {
      var_dump($e->getMessage());
      return false;
    }
  }


  public function count()
  {
    try {
      $sql = "select {$this->fields} from {$this->table} {$this->filters->dump()}";

      // var_dump($sql);
      // die();

      $connection = Connection::connect();

      $prepare = $connection->prepare($sql);
      $prepare->execute($this->filters ? $this->filters->getBind() : []);

      return $prepare->rowCount();
    } catch (PDOException $e) {
      var_dump($e->getMessage());
    }
  }
}
