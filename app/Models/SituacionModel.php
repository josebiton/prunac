<?php

namespace App\Models;

use CodeIgniter\Model;


class SituacionModel extends Model
{
    protected $table = 'situacion';
    protected $primaryKey = 'idsituacion';
    protected $returnType = 'array';
    protected $allowedFields = [
        'situacion',        
        'estado'
    ];

    public function getSituacion()
  {
    return $this->db->table('situacion st')
      ->Where('st.estado', 1)
      /*->join('producto p', 'c.idcategoria = p.idproducto')*/
      ->get()->getResultArray();
  }

  public function getId($id)
  {
    return $this->db->table('situacion st')
      ->Where('st.idsituacion', $id)
      ->Where('st.estado', 1)
      
      ->get()->getResultArray();
  }
}
