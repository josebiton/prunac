<?php
namespace App\Controllers;


class Panel extends BaseController{

    public function index(){

        echo view('admin/index');
    }
}