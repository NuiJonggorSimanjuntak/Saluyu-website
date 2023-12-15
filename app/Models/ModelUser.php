<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table                = 'customer';
    protected $primaryKey           = 'id';
    protected $allowedFields        = ['id_user', 'name', 'telephone', 'address'];

    public function getUser()
    {
        return $this->table('customer')->select('id_user, name, telephone, address');
    }
}
