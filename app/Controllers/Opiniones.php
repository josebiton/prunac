<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\OpinionesModel;
use App\Models\RegistrosModel;

class Opiniones extends Controller
{
  public function index()
  {
    $request = \Config\Services::request();
    $validation = \Config\Services::validation();
    $headers = $request->getHeaders();
    $model = new RegistrosModel();
    $registro = $model->where('estado', 1)->findAll();

    foreach ($registro as $key => $value) {
      if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
          $model = new OpinionesModel();
          $coment = $model->getOpiniones();
          if (!empty($coment)) {
            $data = array(
              "status" => 200,
              "total de registros" => count($coment),
              "Detalles" => $coment
            );
          } else {
            $data = array(
              "status" => 200,
              "total de registros" => count($coment),
              "Detalles" => "no hay registros"
            );
          }
          return json_encode($data, true);
        } else {
          $data = array(
            "Status" => 404,
            "Detalles" => "El token es incorrecto "
          );
        }
      } else {
        $data = array(
          "Status" => 404,
          "Detalles" => "No posee autorización"
        );
      }
    }
    return json_encode($data, true);
  }

  public function show($id)
  {
    $request = \Config\Services::request();
    $validation = \Config\Services::validation();
    $headers = $request->getHeaders();
    $model = new RegistrosModel();
    $registro = $model->where('estado', 1)->findAll();

    foreach ($registro as $key => $value) {
      if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
          $model = new OpinionesModel();
          $coment = $model->getId($id);
          if (!empty($coment)) {
            $data = array(
              "status" => 200,
              "Detalles" => $coment
            );
          } else {
            $data = array(
              "status" => 404,
              "Detalles" => "No hay registro "
            );
          }
          return json_encode($data, true);
        } else {
          $data = array(
            "Status" => 404,
            "Detalles" => "El token es incorrecto "
          );
        }
      } else {
        $data = array(
          "Status" => 404,
          "Detalles" => "No posee autorización"
        );
      }
    }
    return json_encode($data, true);
  } //ejecutado

  public function create()
  {
    $request = \Config\Services::request();
    $validation = \Config\Services::validation();
    $headers = $request->getHeaders();
    $model = new RegistrosModel();
    $registro = $model->where('estado', 1)->findAll();

    foreach ($registro as $key => $value) {
      if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
          $datos = array(
            "idclientes" => $request->getVar("idclientes"),
            "comentario" => $request->getVar("comentario")            
          );
          if (!empty($datos)) {
            $validation->setRules([
              "idclientes" => 'required|string|max_length[255]',
              "comentario" => 'required|string|max_length[255]'
              
            ]);
            $validation->withRequest($this->request)->run();
            if ($validation->getErrors()) {
              $errors = $validation->getErrors();
              $data = array("Status" => 404, "Detalle" => $errors);
              return json_encode($data, true);
            } else {
              $datos = array(
                "idclientes" => $datos["idclientes"],
                "comentario" => $datos["comentario"]
                
              );
              $model = new OpinionesModel();
              $coment = $model->insert($datos);
              $data = array(
                "Status" => 200,
                "Detalle" => "Registro existoso"
              );
              return json_encode($data, true);
            }
          } else {
            $data = array(
              "Status" => 404,
              "Detalle" => "Registro con errores"
            );
            return json_encode($data, true);
          }
        } else {
          $data = array(
            "Status" => 404,
            "Detalles" => "El token es incorrecto"
          );
        }
      } else {
        $data = array(
          "Status" => 404,
          "Detalles" => "No posee autorización"
        );
      }
    }
    return json_encode($data, true);
  } //ejecutado

  public function update($id)
  {
    $request = \Config\Services::request();
    $validation = \Config\Services::validation();
    $headers = $request->getHeaders();
    $model = new RegistrosModel();
    $registro = $model->where('estado', 1)->findAll();

    foreach ($registro as $key => $value) {
      if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
          $datos = $this->request->getRawInput();
          if (!empty($datos)) {
            $validation->setRules([
              "idclientes" => 'required|string|max_length[255]',
              "comentario" => 'required|string|max_length[255]'
              
            ]);
            $validation->withRequest($this->request)->run();
            if ($validation->getErrors()) {
              $errors = $validation->getErrors();
              $data = array("Status" => 404, "Detalle" => $errors);
              return json_encode($data, true);
            } else {
              $model = new OpinionesModel();
              $coment = $model->find($id);
              if (is_null($coment)) {
                $data = array(
                  "Status" => 404,
                  "Detalles" => "registro no existe"
                );
                return json_encode($data, true);
              } else {
                $datos = array(
                  "idclientes" => $datos["idclientes"],
                  "coemtario" => $datos["coemtario"]                  
                );
                $model = new OpinionesModel();
                $coment  = $model->update($id, $datos);
                $data = array(
                  "Status" => 200,
                  "Detalles" => "datos actualizados"
                );
                return json_encode($data, true);
              }
            }
          } else {
            $data = array(
              "Status" => 404,
              "Detalles" => "Registro con errores"
            );
            return json_encode($data, true);
          }
        } else {
          $data = array(
            "Status" => 404,
            "Detalles" => "El token es incorrecto"
          );
        }
      } else {
        $data = array(
          "Status" => 404,
          "Detalles" => "No posee autorización"
        );
      }
    }
    return json_encode($data, true);
  } //ejecutado

  public function delete($id)
  {
    $request = \Config\Services::request();
    $validation = \Config\Services::validation();
    $headers = $request->getHeaders();
    $model = new RegistrosModel();
    $registro = $model->where('estado', 1)->findAll();

    foreach ($registro as $key => $value) {
      if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
          $model = new OpinionesModel();
          $coment = $model->where('estado', 1)->find($id);
          if (!empty($coment)) {
            $datos = array("estado" => 0);
            $coment = $model->update($id, $datos);
            $data = array(
              "status" => 200,
              "Detalles" => "se ha eliminado el registro"
            );
          } else {
            $data = array(
              "status" => 404,
              "Detalles" => "No hay registros o tu código está mal -_-"
            );
          }
          return json_encode($data, true);
        } else {
          $data = array(
            "Status" => 404,
            "Detalles" => "El token es incorrecto o tu código está mal -_-"
          );
        }
      } else {
        $data = array(
          "Status" => 404,
          "Detalles" => "No posee autorización"
        );
      }
    }
    return json_encode($data, true);
  } //ejecutado

}
