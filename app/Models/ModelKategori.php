<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKategori extends Model
{
    protected $table                = 'catalog_kategori';
    protected $primaryKey           = 'id';
    protected $allowedFields        = ['kategori'];

    public function getKategori()
    {
        return $this->table('catalog_kategori')->select('id, kategori');
    }
}
