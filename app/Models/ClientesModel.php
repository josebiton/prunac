<?php 
namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model{
    protected $table      = 'clientes';
    protected $primaryKey = 'idcliente';
    protected $returnType     = 'array';
        protected $allowedFields = [
        'nombre',
        'apellidos',
        'dni',
        'direccion',
        'telefono',
        'email',
        'estado'
    ];
}