<?php

namespace app\database;

class Filters
{
    private array $filters = [];
    private array $binds = [];
    private array $conditions = [];
    
    private int $counter = 0; // para gerar placeholders únicos (caso seja necessário futuramente)

    /**
     * Adiciona uma condição na cláusula WHERE.
     *
     * Suporta:
     * - Valores escalares (string, int, etc.) – usa bind único
     * - Arrays para IN/NOT IN – gera placeholders múltiplos
     * - Arrays de dois elementos para BETWEEN
     *
     * @param string $field Nome do campo (pode ser com alias, ex: "users.id")
     * @param string $operator Operador SQL (por exemplo, '=', 'LIKE', 'IN', 'BETWEEN', etc.)
     * @param mixed $value Valor ou array de valores
     * @param string $logic Operador lógico para concatenar com a condição anterior (padrão: 'AND')
     *
     * @return $this
     * @throws \InvalidArgumentException se o operador não for compatível com o tipo de $value
     */
    public function where(string $field, string $operator, mixed $value, string $logic = 'AND'): self
    {
        // Remove pontos do nome do campo para usar no bind, se houver alias (ex.: "users.id" vira "usersid")
        $fieldBind = str_contains($field, '.') ? str_replace('.', '', $field) : $field;
        $placeholder = ":{$fieldBind}" . (is_array($value) ? "_array" : "");
        
        $condition = '';
        switch (strtoupper($operator)) {
            case 'IN':
            case 'NOT IN':
                if (!is_array($value)) {
                    throw new \InvalidArgumentException("O operador {$operator} requer um array como valor.");
                }
                // Cria placeholders únicos para cada item do array
                $placeholders = array_map(fn($key) => "{$placeholder}_{$key}", array_keys($value));
                $condition = "{$field} {$operator} (" . implode(', ', $placeholders) . ")";
                foreach ($value as $key => $val) {
                    $this->binds["{$fieldBind}_array_{$key}"] = $val;
                }
                break;

            case 'BETWEEN':
                if (!is_array($value) || count($value) !== 2) {
                    throw new \InvalidArgumentException("O operador BETWEEN requer um array com dois valores.");
                }
                $condition = "{$field} BETWEEN {$placeholder}_1 AND {$placeholder}_2";
                $this->binds["{$fieldBind}_array_1"] = $value[0];
                $this->binds["{$fieldBind}_array_2"] = $value[1];
                break;

            case 'LIKE':
                $condition = "{$field} LIKE {$placeholder}";
                $this->binds[$fieldBind] = "%{$value}%";
                break;

            case 'IS NULL':
            case 'IS NOT NULL':
                $condition = "{$field} {$operator}";
                break;

            case 'FIND_IN_SET':
                $condition = "FIND_IN_SET({$placeholder}, {$field})";
                $this->binds[$fieldBind] = $value;
                break;

            case 'MATCH':
                $condition = "MATCH({$field}) AGAINST({$placeholder} IN BOOLEAN MODE)";
                $this->binds[$fieldBind] = $value;
                break;

            default:
                $condition = "{$field} {$operator} {$placeholder}";
                $this->binds[$fieldBind] = is_bool($value) ? (int)$value : $value;
                break;
        }

        // Se já houver uma condição, adiciona o operador lógico antes da nova condição
        if (!empty($this->filters['where'])) {
            $this->filters['where'][] = $logic;
        }
        $this->filters['where'][] = $condition;
        
        return $this;
    }

    /**
     * Retorna os binds configurados para a consulta.
     *
     * @return array
     */
    public function getBind(): array
    {
        return $this->binds;
    }

    /**
     * Define o LIMIT da consulta.
     *
     * @param int $limit
     * @return self
     */
    public function limit(int $limit): self
    {
        $this->conditions['limit'] = "LIMIT {$limit}";
        return $this;
    }

    /**
     * Define a ordenação.
     *
     * @param string $field
     * @param string $order
     * @return self
     */
    public function orderBy(string $field, string $order = 'ASC'): self
    {
        $this->conditions['order'] = "ORDER BY {$field} {$order}";
        return $this;
    }

    /**
     * Adiciona uma condição JOIN.
     *
     * @param string $foreignTable A tabela a ser unida
     * @param string $joinTable1 Primeira parte da condição JOIN (ex.: "users.id")
     * @param string $operator Operador de comparação (ex.: '=')
     * @param string $joinTable2 Segunda parte da condição JOIN (ex.: "orders.user_id")
     * @param string $joinType Tipo de JOIN (padrão: 'INNER JOIN')
     * @return self
     */
    public function join(
        string $foreignTable,
        string $joinTable1,
        string $operator,
        string $joinTable2,
        string $joinType = 'INNER JOIN'
    ): self {
        if (!isset($this->conditions['join'])) {
            $this->conditions['join'] = [];
        }
        $this->conditions['join'][] = "{$joinType} {$foreignTable} ON {$joinTable1} {$operator} {$joinTable2}";
        return $this;
    }

    /**
     * Constrói a cláusula SQL completa com JOIN, WHERE, ORDER BY e LIMIT.
     *
     * @return string
     */
    public function dump(): string
    {
        $parts = [];

        // Adiciona JOIN se existir
        if (isset($this->conditions['join'])) {
            $parts[] = implode(' ', $this->conditions['join']);
        }

        // Adiciona cláusula WHERE se houver condições definidas
        if (!empty($this->filters['where'])) {
            $parts[] = 'WHERE ' . implode(' ', $this->filters['where']);
        }

        // Adiciona ORDER BY se definido
        if (isset($this->conditions['order'])) {
            $parts[] = $this->conditions['order'];
        }

        // Adiciona LIMIT se definido
        if (isset($this->conditions['limit'])) {
            $parts[] = $this->conditions['limit'];
        }

        return implode(' ', $parts);
    }
}
