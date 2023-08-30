<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'razon_social' => 'Empresa 1',
                'nombre_comercial' => 'Empresa 1',
                'representante_legal' => 'Representante 1',
                'ruc' => '12345678901',
                'descripcion' => 'Descripción de la empresa 1',
                'icono' => 'empresa1.png',
                'color' => '#ff0000',
                'direccion' => 'Calle 1, Ciudad 1',
                'referencia' => 'Referencia 1',
                'lat' => '12.345678',
                'lgn' => '-87.654321',
                'telefono' => '123456789',
                'correo' => 'empresa1@example.com',
                'facebook' => 'https://facebook.com/empresa1',
                'twitter' => 'https://twitter.com/empresa1',
                'instagram' => 'https://instagram.com/empresa1',
                'google+' => 'https://plus.google.com/empresa1',
                'baner' => 'banner_empresa1.jpg',
                
            ],
            [
                'razon_social' => 'Empresa 2',
                'nombre_comercial' => 'Empresa 2',
                'representante_legal' => 'Representante 2',
                'ruc' => '98765432109',
                'descripcion' => 'Descripción de la empresa 2',
                'icono' => 'empresa2.png',
                'color' => '#00ff00',
                'direccion' => 'Calle 2, Ciudad 2',
                'referencia' => 'Referencia 2',
                'lat' => '23.456789',
                'lgn' => '-76.543210',
                'telefono' => '987654321',
                'correo' => 'empresa2@example.com',
                'facebook' => 'https://facebook.com/empresa2',
                'twitter' => 'https://twitter.com/empresa2',
                'instagram' => 'https://instagram.com/empresa2',
                'google+' => 'https://plus.google.com/empresa2',
                'baner' => 'banner_empresa2.jpg',
                
            ]
        ];

        $this->db->table('empresa')->insertBatch($data);
    }
}

