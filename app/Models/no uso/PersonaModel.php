<?php

namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table = 'persona';
    protected $primaryKey = 'persona_id';

    protected $allowedFields = [
        'dni',
        'nombres',
        'apellidos',
        'telefono',
        'estado'
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'dni' => 'required|exact_length[11]',
        'nombres' => 'required',
        'apellidos' => 'required',
        'telefono' => 'required'
    ];

    protected $validationMessages = [
        'dni' => [
            'required' => 'El campo de DNI es obligatorio.',
            'exact_length' => 'El DNI debe tener exactamente 11 caracteres.'
        ],
        'nombres' => [
            'required' => 'El campo de nombres es obligatorio.'
        ],
        'apellidos' => [
            'required' => 'El campo de apellidos es obligatorio.'
        ],
        'telefono' => [
            'required' => 'El campo de teléfono es obligatorio.'
        ]
    ];

    public function getPersonaById($personaId)
    {
        return $this->find($personaId);
    }

    public function updatePersona($personaId, $data)
    {
        $this->update($personaId, $data);
    }

    public function deletePersona($personaId)
    {
        $this->delete($personaId);
    }

    // Aquí hay un ejemplo de un método para buscar personas por su DNI
    public function searchByDni($dni)
    {
        return $this->where('dni', $dni)->findAll();
    }

    // Aquí puedes agregar métodos adicionales para interactuar con la tabla 'persona' según tus necesidades.
}
