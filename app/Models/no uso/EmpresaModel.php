<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table = 'empresa';
    protected $primaryKey = 'empresa_id';

    protected $allowedFields = [
        'razon_social',
        'nombre_comercial',
        'representante_legal',
        'ruc',
        'descripcion',
        'icono',
        'color',
        'direccion',
        'referencia',
        'lat',
        'lgn',
        'telefono',
        'correo',
        'facebook',
        'twitter',
        'instagram',
        'google+',
        'baner',
        'estado'
    ];

    protected $useTimestamps = true;

    protected $validationRules = [
        'razon_social' => 'required',
        'nombre_comercial' => 'required',
        'ruc' => 'required|exact_length[11]',
        'correo' => 'required|valid_email'
    ];

    protected $validationMessages = [
        'razon_social' => [
            'required' => 'El campo de razón social es obligatorio.'
        ],
        'nombre_comercial' => [
            'required' => 'El campo de nombre comercial es obligatorio.'
        ],
        'ruc' => [
            'required' => 'El campo de RUC es obligatorio.',
            'exact_length' => 'El RUC debe tener exactamente 11 caracteres.'
        ],
        'correo' => [
            'required' => 'El campo de correo electrónico es obligatorio.',
            'valid_email' => 'Ingresa un correo electrónico válido.'
        ]
    ];

    public function getEmpresaById($empresaId)
    {
        return $this->find($empresaId);
    }

    public function updateEmpresa($empresaId, $data)
    {
        $this->update($empresaId, $data);
    }

    public function deleteEmpresa($empresaId)
    {
        $this->delete($empresaId);
    }

    // Aquí puedes agregar más métodos según tus necesidades.
}
