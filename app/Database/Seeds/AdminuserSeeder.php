<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminuserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
            	'firstname'		=>	'Admin',
            	'lastname'		=>	'Admin',
                'username'		=>	'admin',
                'email'			=>	'admin@gmail.com',
                'password'		=>	password_hash('password', PASSWORD_DEFAULT),
            ],
        ];
        $this->db->table('adminusers')->insertBatch($data);
    }
}
