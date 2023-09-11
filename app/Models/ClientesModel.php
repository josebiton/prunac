<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
  protected $table      = 'clientes';
  protected $primaryKey = 'idclientes';
  protected $returnType     = 'array';
  protected $allowedFields = ['nombreCliente','apellidoCliente','emailCliente','imagen','estado'];

  public function getClientes()
  {
    return $this->db->table('clientes cl')
      ->Where('cl.estado', 1)
      /*->join('producto p', 'c.idcategoria = p.idproducto')*/
      ->get()->getResultArray();
  }

  public function getId($id)
  {
    return $this->db->table('clientes cl')
    ->Where('cl.idclientes', $id)
      ->Where('cl.estado', 1)
      
      ->get()->getResultArray();
  }
  /*public function getProducto()
  {
    return $this->db->table('producto p')
      ->Where('p.estado', 1)
      ->get()->getResultArray();
  }*/
}
