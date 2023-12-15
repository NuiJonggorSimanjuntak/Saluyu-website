<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSubMenu extends Model
{
    protected $table            = 'sub_menu';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['menu_id', 'title', 'url', 'active'];

    public function getSubMenu()
    {
        $modelUser = new ModelUsers();
        $roleId = 'default_role';
        if (!empty(user()->id)) {
            $user = $modelUser->getUsers()->where('users.id', user()->id)->first();
            if (!empty($user)) {
                $roleId = $user->role;
            }
        }
        $query = $this->table('sub_menu')->select('sub_menu.id, menu_id, auth_permissions.description as menu, url, title, active')
            ->join('auth_permissions', 'auth_permissions.id = sub_menu.menu_id');

        return $query;
    }
}
