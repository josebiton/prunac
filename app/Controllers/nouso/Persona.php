<?php

namespace App\Controllers;

use App\Models\PersonaModel;
use CodeIgniter\API\ResponseTrait;

class PersonaController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $personaModel = new PersonaModel();
        $personas = $personaModel->findAll();

        return $this->respond($personas);
    }

    public function show($id)
    {
        $personaModel = new PersonaModel();
        $persona = $personaModel->getPersonaById($id);

        if ($persona === null) {
            return $this->failNotFound('Persona no encontrada.');
        }

        return $this->respond($persona);
    }

    public function create()
    {
        $personaModel = new PersonaModel();

        $data = $this->getRequestData();

        if (!$personaModel->insert($data)) {
            return $this->failServerError('No se pudo crear la persona.');
        }

        $response = [
            'message' => 'Persona creada exitosamente.',
            'data' => $data
        ];

        return $this->respondCreated($response);
    }

    public function update($id)
    {
        $personaModel = new PersonaModel();

        $data = $this->getRequestData();

        if (!$personaModel->getPersonaById($id)) {
            return $this->failNotFound('Persona no encontrada.');
        }

        $personaModel->updatePersona($id, $data);

        $response = [
            'message' => 'Persona actualizada exitosamente.',
            'data' => $data
        ];

        return $this->respond($response);
    }

    public function delete($id)
    {
        $personaModel = new PersonaModel();

        if (!$personaModel->getPersonaById($id)) {
            return $this->failNotFound('Persona no encontrada.');
        }

        $personaModel->deletePersona($id);

        $response = [
            'message' => 'Persona eliminada exitosamente.'
        ];

        return $this->respondDeleted($response);
    }

    protected function getRequestData()
    {
        $data = $this->request->getJSON();

        return [
            'dni' => $data->dni,
            'nombres' => $data->nombres,
            'apellidos' => $data->apellidos,
            'telefono' => $data->telefono,
            'estado' => $data->estado
        ];
    }
}
