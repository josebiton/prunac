<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ObjetivosModel;
use App\Models\RegistrosModel;
class Objetivos extends Controller{
    public function index(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new RegistrosModel();
        $registro = $model->where('estado', 1)->findAll();
        
        foreach($registro as $key=>$value){
            if(array_key_exists('Authorization',$headers) && !empty($headers['Authorization'])){
                if($request->getHeader('Authorization')=='Authorization: Basic '.base64_encode($value['cliente_id'].':'.$value['llave_secreta'])){
                    $model = new ObjetivosModel();
                    $objetivos = $model->getObjetivos();
                    if(!empty($objetivos)){
                        $data = array(
                            "status" => 200,
                            "total de registros"=>count($objetivos),
                            "Detalles" => $objetivos
                        );
                    }
                    else{
                        $data = array(
                            "status" => 200,
                            "total de registros"=>count($objetivos),
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
                    $model = new ObjetivosModel();
                    $objetivos = $model->getId($id);
                    if(!empty($objetivos)){
                        $data = array(
                            "status" => 200,
                            "Detalles" => $objetivos
                        );
                    }
                    else{
                        $data = array(
                            "status" => 404,
                            "Detalles" => "No hay Objetivos"
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
                            "idsituacion"=>$request->getVar("idsituacion"),
                            "nombreObjetivo"=>$request->getVar("nombreObjetivo"),
                            "descripcionObjetivo"=>$request->getVar("descripcionObjetivo"),
                            "fechaInicio"=>$request->getVar("fechaInicio"),
                            "fechaFinal"=>$request->getVar("fechaFinal")
                            
                        );
                        if(!empty($datos)){
                            $validation->setRules([
                                "idsituacion"=>'required|string|max_length[255]',
                                "nombreObjetivo"=>'required|string|max_length[255]',
                                "descripcionObjetivo"=>'required|string|max_length[255]',
                                "fechaInicio"=>'required|string|max_length[255]',
                                "fechaFinal"=>'required|string|max_length[255]'
                                
                            ]);
                            $validation->withRequest($this->request)->run();
                            if($validation->getErrors()){
                                $errors = $validation->getErrors();
                                $data = array("Status"=>404, "Detalle"=>$errors);
                                return json_encode($data, true);
                            }
                            else{
                                $datos = array(
                                    "idsituacion"=>$datos["idsituacion"],
                                    "nombreObjetivo"=>$datos["nombreObjetivo"],
                                    "descripcionObjetivo"=>$datos["descripcionObjetivo"],
                                    "fechaInicio"=>$datos["fechaInicio"],
                                    "fechaFinal"=>$datos["fechaFinal"]
                                   
                                );
                                $model = new ObjetivosModel();
                                $objetivos = $model->insert($datos);
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

    public function upstring($id){
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
                              "idsituacion"=>'required|string|max_length[255]',
                              "nombreObjetivo"=>'required|string|max_length[255]',
                              "descripcionObjetivo"=>'required|string|max_length[255]',
                              "fechaInicio"=>'required|string|max_length[255]',
                              "fechaFinal"=>'required|string|max_length[255]'
                                
                            ]);
                            $validation->withRequest($this->request)->run();
                            if($validation->getErrors()){
                                $errors = $validation->getErrors();
                                $data = array("Status"=>404, "Detalle"=>$errors);
                                return json_encode($data, true);
                            }
                            else{
                                $model = new ObjetivosModel();
                                $objetivos = $model->find($id);
                                if(is_null($objetivos)){
                                    $data = array(
                                        "Status"=>404, 
                                        "Detalles"=>"registro no existe"
                                    );
                                    return json_encode ($data, true);
                                }else{
                                    $datos = array(
                                      "idsituacion"=>$datos["idsituacion"],
                                      "nombreObjetivo"=>$datos["nombreObjetivo"],
                                      "descripcionObjetivo"=>$datos["descripcionObjetivo"],
                                      "fechaInicio"=>$datos["fechaInicio"],
                                      "fechaFinal"=>$datos["fechaFinal"]
                                        
                                    );
                                    $model = new ObjetivosModel();
                                    $objetivos  = $model->upstring($id, $datos);
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
                    $model = new ObjetivosModel();
                    $objetivos = $model->where('estado',1)->find($id);
                    if(!empty($objetivos)){
                        $datos = array("estado"=>0);
                        $objetivos = $model->upstring($id, $datos);
                        $data = array(
                            "status" => 200,
                            "Detalles" => "se ha eliminado el registro"
                        );
                    }
                    else{
                        $data = array(
                            "status" => 404,
                            "Detalles" => "No hay registros o tu código está mal -_-"
                        );
                    }
                    return json_encode($data, true);
                }
                else{
                    $data = array(
                        "Status"=>404,
                        "Detalles"=>"El token es incorrecto o tu código está mal -_-"
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