<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriasModel extends Model
{
  protected $table      = 'categoria';
  protected $primaryKey = 'idcategoria';
  protected $returnType     = 'array';
  protected $allowedFields = ['nombreCategoria','descripcionCategoria','estado'];

  public function getCategorias()
  {
    return $this->db->table('categoria c')
      ->Where('c.estado', 1)
      /*->join('producto p', 'c.idcategoria = p.idproducto')*/
      ->get()->getResultArray();
  }

  public function getId($id)
  {
    return $this->db->table('categoria c')
    ->Where('c.idcategoria', $id)
      ->Where('c.estado', 1)
      
      ->get()->getResultArray();
  }
  /*public function getProducto()
  {
    return $this->db->table('producto p')
      ->Where('p.estado', 1)
      ->get()->getResultArray();
  }*/
}
