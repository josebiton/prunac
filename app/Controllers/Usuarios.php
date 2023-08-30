<?php 
namespace App\Controllers;

use App\Models\RegistrosModel;

use App\Models\UsuariosModel;
class Usuarios extends BaseController{

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
                    $model = new UsuariosModel();
                    $resultado = $model->where('estado', 1)->findAll();
                    if (!empty($resultado)) {
                        $data = array(
                            "Status" => 200,
                            "Total de  registros" => count($resultado),
                            "Detalles" => $resultado
                        );
                    } else {
                        $data = array(
                            "Status" => 404,
                            "Total de  registros" => 0,
                            "Detalles" => "No hay registros"
                        );
                    }
                    return json_encode($data, true);
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
    } 
    public function show($id)
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        // var_dump($registro); die; 

        foreach ($registro as $key => $value) {
            if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
                if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
                    $model = new UsuariosModel();
                    $resultado = $model->where('estado', 1)->find($id);
                    if (!empty($resultado)) {
                        $data = array(
                            "Status" => 200,
                            "Detalles" => $resultado
                        );
                    } else {
                        $data = array(
                            "Status" => 404,
                            "Detalles" => "No hay registros"
                        );
                    }
                    return json_encode($data, true);
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
    }
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
                        "nombre_usuario" => $request->getVar("nombre_usuario"),
                        "contrasena" => $request->getVar("contrasena"),
                    );
                    
                    if (!empty($datos)) {
                        $validation->setRules([
                            "nombre_usuario" => 'required|string|max_length[100]',
                            "contrasena" => 'required|min_length[6]|max_length[255]'
                        ]);
                        $validation->withRequest($this->request)->run();
                        
                        if ($validation->getErrors()) {
                            $errors = $validation->getErrors();
                            $data = array("Status" => 404, "Detalle" => $errors);
                            return json_encode($data, true);
                        } else {
                            $datos = array(
                                "nombre_usuario" => $datos["nombre_usuario"],
                                "contrasena" => password_hash($datos["contrasena"], PASSWORD_DEFAULT) // Hasheamos la contraseña
                            );
                            
                            $model = new UsuariosModel();
                            $cliente = $model->insert($datos);
                            $data = array(
                                "Status" => 200,
                                "Detalles" => "Registro exitoso"
                            );
                            return json_encode($data, true);
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
    }
    

    public function delete($id)
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        // var_dump($registro); die; 

        foreach ($registro as $key => $value) {
            if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
                if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
                    $model = new UsuariosModel();
                    $resultado = $model->where('estado', 1)->find($id);
                    if (!empty($resultado)) {
                        $datos = array("estado"=>0);
                        $resultado = $model->update($id, $datos);
                        $data = array(
                            "Status" => 200,
                            "Detalles" => "Se ha eliminado el registro"
                        );
                    } else {
                        $data = array(
                            "Status" => 404,
                            "Detalles" => "No hay registros"
                        );
                    }
                    return json_encode($data, true);
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
    }
}
