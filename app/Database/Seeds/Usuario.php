<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usuario extends Seeder
{
    public function run()
    {
        $nombre = "Mesias";
        $apellido = "Orrego";
        $usuario = "mesias";
        $email = "mesias@gmail.com";
        $password = password_hash('1234', PASSWORD_DEFAULT);
        $perfil = "default.png";


        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'usuario' => $usuario,
            'correo_electronico' => $email,
            'contrasena'  => $password,
            'perfil'  => $perfil
        ];

        // Using Query Builder
        $this->db->table('superadmin')->insert($data);
    }
}
