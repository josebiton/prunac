<?php

namespace App\Models;

use CodeIgniter\Model;

class TiendaModel extends Model
{
    protected $table = 'tiendas';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['nombre', 'imagen', 'direccion', 'ciudad', 'telefono', 'estado'];

    public function getTiendas()
    {
        return $this->where('estado', 1)->findAll();
    }

    public function getTienda($id)
    {
        return $this->find($id);
    }
}
