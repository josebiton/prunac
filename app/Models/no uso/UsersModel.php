<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
protected $returnType = 'array';
    protected $allowedFields = [
        'empresa_id',
        'persona_id',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;


    public function getUsersByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getUsersByEmpresa($empresaId)
    {
        return $this->where('empresa_id', $empresaId)->findAll();
    }

    public function updateUser($id, $data)
    {
        $this->update($id, $data);
    }

    public function deleteUser($id)
    {
        $this->delete($id);
    }

    // Aquí puedes agregar más métodos según tus necesidades.
}
