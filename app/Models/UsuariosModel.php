<?php 
namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model{
    protected $table      = 'usuarios';
    protected $primaryKey = 'idusuario';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nombre_usuario',
        'contrasena',
        'estado'
    ];
}