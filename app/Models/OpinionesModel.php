<?php

namespace App\Models;

use CodeIgniter\Model;

class OpinionesModel extends Model
{
  protected $table      = 'comentarios';
  protected $primaryKey = 'idcomentarios';
  protected $returnType     = 'array';
  protected $allowedFields = [
    'idclientes',
    'comentario',
    'estado'
  ];
  public function getOpiniones()
  {
    return $this->db->table('comentarios cmt')
      ->Where('cmt.estado', 1)
      ->join('clientes cl', 'cmt.idclientes = cl.idclientes')
      ->get()->getResultArray();
  }

  public function getId($id)
  {
    return $this->db->table('comentarios cmt')
    ->Where('cmt.idcomentarios',$id)
    ->Where('cmt.estado', 1)
    ->join('clientes cl', 'cmt.idclientes = cl.idclientes')
    ->get()->getResultArray();
  }
  public function getClientes()
  {
    return $this->db->table('clientes cl')
      ->Where('cl.estado', 1)
      ->get()->getResultArray();
  }
}
