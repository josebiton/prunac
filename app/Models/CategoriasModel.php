<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriasModel extends Model
{
  protected $table      = 'categoria';
  protected $primaryKey = 'idcategoria';
  protected $returnType     = 'array';
  protected $allowedFields = ['idobjetivos','nombreCategoria','descripcionCategoria','estado'];

  public function getCategorias()
  {
    return $this->db->table('categoria c')
      ->Where('c.estado', 1)
      ->join('objetivos ob', 'c.idcategoria = ob.idobjetivos')
      ->get()->getResultArray();
  }

  public function getId($id)
  {
    return $this->db->table('categoria c')
    ->Where('c.idcategoria', $id)
      ->Where('c.estado', 1)
      ->join('objetivos ob', 'c.idcategoria = ob.idobjetivos')
      ->get()->getResultArray();
  }
  public function getObjetivos()
  {
    return $this->db->table('objetivos ob')
      ->Where('ob.estado', 1)
      ->get()->getResultArray();
  }
}
