<?php

namespace app\database\models;

use app\database\models\Model;
use app\database\Filters;
use PDO;

class Permission extends Model
{
    protected string $table = 'permissions';

    /**
     * Retorna todas as permissões do nível do usuário como array associativo
     */
    public function getPermissionsByLevel(int $levelId): array
    {
        $filters = new Filters();
        //$filters->join('modulos', 'modulos.id', '=', 'permissions.modulo_id', 'inner join');
        $filters->where('nivel_id', '=', $levelId);
        $this->setFilters($filters);

        $rows = $this->fetchAll();
        error_log(print_r($rows, true));
        $permissions = [];

        foreach ($rows as $row) {
            $moduloId = $row->modulo_id;
            if (!isset($permissions[$moduloId])) {
                $permissions[$moduloId] = [];
            }

            if (!empty($row->pode_ver))       $permissions[$moduloId][] = 'ver';
            if (!empty($row->pode_adicionar)) $permissions[$moduloId][] = 'adicionar';
            if (!empty($row->pode_editar))    $permissions[$moduloId][] = 'editar';
            if (!empty($row->pode_excluir))   $permissions[$moduloId][] = 'excluir';
        }

        return $permissions;
    }

    /**
     * Verifica se um array de permissões contém permissão para uma ação específica
     */
    public function hasPermissionInArray(array $permissions, int|string $module, string $action): bool
    {

        return isset($permissions[$module]) && in_array($action, $permissions[$module]);
    }

    /**
     * Verifica permissão diretamente no banco, sem cache
     */
    public function hasPermission(int $levelId, int|string $module, string $action): bool
    {
        $filters = new Filters();
        $filters->where('nivel_id', '=', $levelId, 'or');
        $filters->where('modulo_id', '=', $module);
        $filters->limit(1);

        $this->setFilters($filters);

        $record = $this->fetchAll();
        $record = $record[0] ?? null;

        if (!$record) {
            return false;
        }

        return match ($action) {
            'ver'       => (bool)$record->pode_ver,
            'adicionar' => (bool)$record->pode_adicionar,
            'editar'    => (bool)$record->pode_editar,
            'excluir'   => (bool)$record->pode_excluir,
            default     => false,
        };
    }
}
