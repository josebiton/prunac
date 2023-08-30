<?php

namespace App\Controllers;

use App\Models\RegistrosModel;
use App\Models\UsersModel;
use CodeIgniter\API\ResponseTrait;

class Users extends BaseController
{
    use ResponseTrait;


    // public function index()
    // {


    //     $usersModel = new UsersModel();
    //     $users = $usersModel->findAll();

    //     return $this->respond($users);
    // }


    public function index()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $modelRegistro = new RegistrosModel();
        $registro = $modelRegistro->where('estado', 1)->findAll();

        foreach ($registro as $key => $value) {
            if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
                if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
                    $modelUser = new UsersModel();
                    $users = $modelUser->findAll();
                    if (!empty($users)) {
                        $data = array(
                            "Status" => 200,
                            "Total de registros" => count($users),
                            "Detalles" => $users
                        );
                    } else {
                        $data = array(
                            "Status" => 404,
                            "Total de registros" => 0,
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

        if (empty($data)) {
            $data = array(
                "Status" => 404,
                "Detalles" => "No se encontraron registros"
            );
        }

        return json_encode($data, true);
    }


    public function show($id)
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $modelRegistro = new RegistrosModel();
        $registro = $modelRegistro->where('estado', 1)->findAll();

        foreach ($registro as $key => $value) {
            if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
                if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
                    $modelUser = new UsersModel();
                    $user = $modelUser->find($id);
                    if (!empty($user)) {
                        $data = array(
                            "Status" => 200,
                            "Detalles" => $user
                        );
                    } else {
                        $data = array(
                            "Status" => 404,
                            "Detalles" => "No se encontró el registro"
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

        if (empty($data)) {
            $data = array(
                "Status" => 404,
                "Detalles" => "No se encontraron registros"
            );
        }

        return json_encode($data, true);
    }


    public function create()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $errors = $validation->getErrors();
        $headers = $request->getHeaders();
        $modelRegistro = new RegistrosModel();
        $registro = $modelRegistro->where('estado', 1)->findAll();

        foreach ($registro as $key => $value) {
            if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
                if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
                    // Aquí puedes agregar la lógica para crear un nuevo registro
                    $datos = array(
                        "email" => $request->getVar("email"),
                        "password" => password_hash($request->getVar("password"), PASSWORD_DEFAULT),
                    );
                    if (!empty($datos)) {
                        $validation->setRules([
                            'email' => [
                                'label' => 'Correo electrónico',
                                'rules' => 'required|valid_email',
                                'errors' => [
                                    'required' => 'El campo {field} es obligatorio.',
                                    'valid_email' => 'Ingresa un correo electrónico válido para {field}.'
                                ]
                            ],
                            'password' => [
                                'label' => 'Contraseña',
                                'rules' => 'required|min_length[6]',
                                'errors' => [
                                    'required' => 'El campo {field} es obligatorio.',
                                    'min_length' => 'La contraseña debe tener al menos 6 caracteres para {field}.'
                                ]
                            ]
                        ]);
                        $validation->withRequest($this->request)->run();
                        if ($validation->getErrors()) {
                            $errors = $validation->getErrors();
                            $data = array("Status" => 404, "Detalle" => $errors);
                            return json_encode($data, true);
                        } else {
                            $datos = array(
                                "email" => $datos["email"],
                                "password" => $datos["password"]
                            );
                            $modelUser = new UsersModel();
                            $cliente = $modelUser->insert($datos);
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
    }


    public function update($id = null)
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $errors = $validation->getErrors();
        $headers = $request->getHeaders();
        $modelRegistro = new RegistrosModel();
        $registro = $modelRegistro->where('estado', 1)->findAll();
    
        foreach ($registro as $key => $value) {
            if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
                if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
                    // Aquí puedes agregar la lógica para actualizar el registro
                    $datos = $this->request->getRawInput();
                    if (!empty($datos)) {
                        $validation->setRules([
                            'email' => [
                                'label' => 'Correo electrónico',
                                'rules' => 'required|valid_email',
                                'errors' => [
                                    'required' => 'El campo {field} es obligatorio.',
                                    'valid_email' => 'Ingresa un correo electrónico válido para {field}.'
                                ]
                            ],
                            'password' => [
                                'label' => 'Contraseña',
                                'rules' => 'required|min_length[6]',
                                'errors' => [
                                    'required' => 'El campo {field} es obligatorio.',
                                    'min_length' => 'La contraseña debe tener al menos 6 caracteres para {field}.'
                                ]
                            ]
                        ]);
                        $validation->withRequest($this->request)->run();
                        if ($validation->getErrors()) {
                            $errors = $validation->getErrors();
                            $data = array("Status" => 404, "Detalle" => $errors);
                            return json_encode($data, true);
                        } else {
                            $modelUser = new UsersModel();
                            $cliente = $modelUser->find($id);

                            if(is_null($cliente)) {
                                $data = array ("Status" => 404, "Detalle" => "Usuario no existe");
                                return json_encode($data, true);
                            }else{
                                $datos = array(
                                    "email" => $datos["email"],
                                    "password" => password_hash($request->getVar("password"), PASSWORD_DEFAULT),
                                );
                                $model = new UsersModel();
                                $cliente = $model->update($id, $datos);
                                $data = array(
                                    "Status" => 200,
                                    "Detalle" => "Actualización exitosa"
                                );
                            }
                        }
                    } else {
                        $data = array(
                            "Status" => 404,
                            "Detalle" => "Actualización con errores"
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
        $modelRegistro = new RegistrosModel();
        $registro = $modelRegistro->where('estado', 1)->findAll();

        foreach ($registro as $key => $value) {
            if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
                if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['cliente_id'] . ':' . $value['llave_secreta'])) {
                    // Aquí puedes agregar la lógica para eliminar el registro con el ID proporcionado
                    $data = array(
                        "Status" => 200,
                        "Detalles" => "Registro eliminado exitosamente"
                    );
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

        if (empty($data)) {
            $data = array(
                "Status" => 404,
                "Detalles" => "No se encontraron registros"
            );
        }

        return json_encode($data, true);
    }
}
