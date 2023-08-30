<?php

namespace App\Controllers;

use App\Models\EmpresaModel;
use CodeIgniter\API\ResponseTrait;

class Empresa extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $empresaModel = new EmpresaModel();
        $empresas = $empresaModel->findAll();

        return $this->respond($empresas);
    }

    public function show($id)
    {
        $empresaModel = new EmpresaModel();
        $empresa = $empresaModel->find($id);

        if ($empresa === null) {
            return $this->failNotFound('Empresa no encontrada.');
        }

        return $this->respond($empresa);
    }

    public function create()
    {
        $empresaModel = new EmpresaModel();

        $data = $this->getRequestData();

        if (!$empresaModel->insert($data)) {
            return $this->failServerError('No se pudo crear la empresa.');
        }

        $response = [
            'message' => 'Empresa creada exitosamente.',
            'data' => $data
        ];

        return $this->respondCreated($response);
    }

    public function update($id)
    {
        $empresaModel = new EmpresaModel();

        $data = $this->getRequestData();

        if (!$empresaModel->update($id, $data)) {
            return $this->failServerError('No se pudo actualizar la empresa.');
        }

        $response = [
            'message' => 'Empresa actualizada exitosamente.',
            'data' => $data
        ];

        return $this->respond($response);
    }

    public function delete($id)
    {
        $empresaModel = new EmpresaModel();

        if (!$empresaModel->delete($id)) {
            return $this->failServerError('No se pudo eliminar la empresa.');
        }

        $response = [
            'message' => 'Empresa eliminada exitosamente.'
        ];

        return $this->respondDeleted($response);
    }

    protected function getRequestData()
    {
        $data = $this->request->getJSON();

        return [
            'razon_social' => $data->razon_social,
            'nombre_comercial' => $data->nombre_comercial,
            'representante_legal' => $data->representante_legal,
            'ruc' => $data->ruc,
            'descripcion' => $data->descripcion,
            'icono' => $data->icono,
            'color' => $data->color,
            'direccion' => $data->direccion,
            'referencia' => $data->referencia,
            'lat' => $data->lat,
            'lgn' => $data->lgn,
            'telefono' => $data->telefono,
            'correo' => $data->correo,
            'facebook' => $data->facebook,
            'twitter' => $data->twitter,
            'instagram' => $data->instagram,
            'google+' => $data->googleplus,
            'baner' => $data->baner,
            'estado' => $data->estado
        ];
    }




}
