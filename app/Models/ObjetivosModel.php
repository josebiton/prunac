<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjetivosModel extends Model
{
  protected $table      = 'objetivos';
  protected $primaryKey = 'idobjetivos';
  protected $returnType     = 'array';
  protected $allowedFields = [
    'idsituacion',
    'nombreObjetivo',
    'descripcionObjetivo',
    'fechaInicio',
    'fechaFinal',
    'estado'
  ];
  public function getObjetivos()
  {
    return $this->db->table('objetivos ob')
    
      ->Where('ob.estado', 1)
      ->join('situacion st', 'ob.idsituacion = st.idsituacion')
      ->get()->getResultArray();
  }

  public function getId($id)
  {
    return $this->db->table('objetivos ob')
    ->Where('ob.idobjetivos',$id)
      ->Where('ob.estado', 1)
      ->join('situacion st', 'ob.idsituacion = st.idsituacion')
      ->get()->getResultArray();
  }
  public function getSituacion()
  {
    return $this->db->table('situacion st')
     
      ->Where('st.estado', 1)
      ->get()->getResultArray();
  }
}
