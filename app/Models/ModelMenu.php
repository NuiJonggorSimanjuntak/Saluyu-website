<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMenu extends Model
{
    protected $table            = 'auth_groups_permissions';
    protected $allowedFields    = ['group_id', 'permission_id'];

    public function getMenu()
    {
        $modelUser = new ModelUsers();
        $roleId = 'default_role';
        if (!empty(user()->id)) {
            $user = $modelUser->getUsers()->where('users.id', user()->id)->first();
            if (!empty($user)) {
                $roleId = $user->role;
            }
        }
        $query = $this->table('auth_groups_permissions')->select('auth_permissions.id, auth_groups.name, auth_permissions.name as menuName, auth_permissions.description')
            ->join('auth_groups', 'auth_groups.id = auth_groups_permissions.group_id')
            ->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id')
            ->where('auth_groups.name', $roleId)
            ->orderBy('auth_groups_permissions.permission_id', 'asc');

        return $query;
    }
}
