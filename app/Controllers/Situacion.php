<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SituacionModel;
use App\Models\RegistrosModel;
class Situacion extends Controller{
    public function index(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new SituacionModel();
                    $situacion = $model->getSituacion();
                    if(!empty($situacion)){
                        $data = array(
                            "status" => 200,
                            "total de registros"=>count($situacion),
                            "Detalles" => $situacion
                        );
                    }
                    else{
                        $data = array(
                            "status" => 200,
                            "total de registros"=>count($situacion),
                            "Detalles" => "no hay registros"
                        );
                    }
                    return json_encode($data, true);
                }
                else{
                    $data = array(
                        "Status"=>404,
                        "Detalles"=>"El token es incorrecto "
                    );
                }
            }
            else{
                $data = array(
                    "Status"=>404,
                    "Detalles"=>"No posee autorización"
                );
            }
        }
        return json_encode($data, true);
    }

    public function show ($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new SituacionModel();
                    $situacion = $model->getId($id);
                    if(!empty($situacion)){
                        $data = array(
                            "status" => 200,
                            "Detalles" => $situacion
                        );
                    }
                    else{
                        $data = array(
                            "status" => 404,
                            "Detalles" => "No hay registro de la situacion"
                        );
                    }
                    return json_encode($data, true);
                }
                else{
                    $data = array(
                        "Status"=>404,
                        "Detalles"=>"El token es incorrecto "
                    );
                }
            }
            else{
                $data = array(
                    "Status"=>404,
                    "Detalles"=>"No posee autorización"
                );
            }
        }
        return json_encode($data, true);
    }

    public function create(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                        $datos = array(
                            "situacion"=>$request->getVar("situacion")
                             
                        );
                        if(!empty($datos)){
                            $validation->setRules([
                                "situacion"=>'required|string|max_length[255]'
                                  
                            ]);
                            $validation->withRequest($this->request)->run();
                            if($validation->getErrors()){
                                $errors = $validation->getErrors();
                                $data = array("Status"=>404, "Detalle"=>$errors);
                                return json_encode($data, true);
                            }
                            else{
                                $datos = array(
                                    "situacion"=>$datos["situacion"]
                                    
                                   
                                );
                                $model = new SituacionModel();
                                $situacion = $model->insert($datos);
                                $data = array(
                                    "Status"=>200,
                                    "Detalle"=>"Registro existoso"
                                );
                                return json_encode($data, true);
                            }
                        }
                        else{
                            $data = array(
                                "Status"=>404,
                                "Detalle"=>"Registro con errores"
                            );
                            return json_encode($data, true);
                        }
                }
                else{
                    $data = array(
                        "Status"=>404,
                        "Detalles"=>"El token es incorrecto"
                    );
                }
            }
            else{
                $data = array(
                    "Status"=>404,
                    "Detalles"=>"No posee autorización"
                );
            }
        }
        return json_encode($data, true);
    }

    public function update($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                        $datos = $this->request->getRawInput();
                        if(!empty($datos)){
                            $validation->setRules([
                              "situacion"=>'required|string|max_length[255]'
                              
                            ]);
                            $validation->withRequest($this->request)->run();
                            if($validation->getErrors()){
                                $errors = $validation->getErrors();
                                $data = array("Status"=>404, "Detalle"=>$errors);
                                return json_encode($data, true);
                            }
                            else{
                                $model = new SituacionModel();
                                $situacion = $model->find($id);
                                if(is_null($situacion)){
                                    $data = array(
                                        "Status"=>404, 
                                        "Detalles"=>"registro no existe"
                                    );
                                    return json_encode ($data, true);
                                }else{
                                    $datos = array(
                                      "situacion"=>$datos["situacion"]
                                        
                                    );
                                    $model = new SituacionModel();
                                    $situacion  = $model->update($id, $datos);
                                    $data = array(
                                        "Status"=>200, 
                                        "Detalles"=>"datos actualizados"
                                    );
                                    return json_encode ($data, true);
                                }
                            }
                        }
                        else{
                            $data = array(
                                "Status"=>404,
                                "Detalles"=>"Registro con errores"
                            );
                            return json_encode($data, true);
                        }
                }
                else{
                    $data = array(
                        "Status"=>404,
                        "Detalles"=>"El token es incorrecto"
                    );
                }
            }
            else{
                $data = array(
                    "Status"=>404,
                    "Detalles"=>"No posee autorización"
                );
            }
        }
        return json_encode($data, true);
    }

    public function delete($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new SituacionModel();
                    $situacion = $model->where('estado',1)->find($id);
                    if(!empty($situacion)){
                        $datos = array("estado"=>0);
                        $situacion = $model->update($id, $datos);
                        $data = array(
                            "status" => 200,
                            "Detalles" => "se ha eliminado el registro"
                        );
                    }
                    else{
                        $data = array(
                            "status" => 404,
                            "Detalles" => "No hay registros "
                        );
                    }
                    return json_encode($data, true);
                }
                else{
                    $data = array(
                        "Status"=>404,
                        "Detalles"=>"El token es incorrecto "
                    );
                }
            }
            else{
                $data = array(
                    "Status"=>404,
                    "Detalles"=>"No posee autorización"
                );
            }
        }
        return json_encode($data, true);
    }
    
}