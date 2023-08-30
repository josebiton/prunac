<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PersonaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'dni' => '12345678',
                'nombres' => 'Nombre 1',
                'apellidos' => 'Apellido 1',
                'telefono' => '123456789',
            ],
            [
                'dni' => '87654321',
                'nombres' => 'Nombre 2',
                'apellidos' => 'Apellido 2',
                'telefono' => '987654321',
            ]
        ];

        $this->db->table('persona')->insertBatch($data);
    }
}
