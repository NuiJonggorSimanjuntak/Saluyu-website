<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSales extends Model
{
    protected $table            = 'sales';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_user', 'pesanan', 'subtotal', 'tgl_pesanan', 'invoice', 'keterangan', 'admin'];
}
