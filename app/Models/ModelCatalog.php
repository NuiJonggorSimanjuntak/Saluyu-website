<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCatalog extends Model
{
    protected $table                = 'catalog';
    protected $primaryKey           = 'id';
    protected $allowedFields        = ['id_product', 'name_product', 'price', 'image_product', 'id_kategori', 'description', 'stock', 'qty'];

    public function getCatalog()
    {
        return $this->table('catalog')->select('id, id_product, name_product, price, image_product, description, id_kategori, stock, qty')->orderBy('id_product', 'asc');
    }

    public function getCatalogKeyword($keyword)
    {
        return $this->table('catalog')->select('id, id_product, name_product, price, image_product, description, id_kategori, stock, qty')->like('name_product', $keyword);
    }
}
