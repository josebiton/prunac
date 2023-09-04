<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
  protected $table      = 'producto';
  protected $primaryKey = 'idproducto';
  protected $returnType     = 'array';
  protected $allowedFields = [
    'idcategoria',
    'nombre',
    'descripcion',
    'estado'
  ];
  public function getProductos()
  {
    return $this->db->table('producto p')
      ->Where('p.estado', 1)
      ->join('categoria c', 'p.idcategoria = c.idcategoria')
      ->get()->getResultArray();
  }

  public function getId($id)
  {
    return $this->db->table('producto p')
    ->Where('p.idproducto',$id)
      ->Where('p.estado', 1)
      ->join('categoria c', 'p.idcategoria = c.idcategoria')
      ->get()->getResultArray();
  }
  public function getCategoria()
  {
    return $this->db->table('categoria c')
      ->Where('c.estado', 1)
      ->get()->getResultArray();
  }
}
