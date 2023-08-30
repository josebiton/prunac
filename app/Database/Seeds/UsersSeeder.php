<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'empresa_id' => 1,
                'persona_id' => 1,
                'email' => 'mesias@gmail.com',
                'email_verified_at' => null,
                'password' => password_hash('1234', PASSWORD_DEFAULT),
                'remember_token' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'empresa_id' => 1,
                'persona_id' => 2,
                'email' => 'samuel@gmail.com',
                'email_verified_at' => null,
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'remember_token' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
