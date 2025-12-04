<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
            	'firstname'		=>	'John',
            	'lastname'		=>	'Doe',
                'username'		=>	'john',
                'email'			=>	'john@gmail.com',
                'password'		=>	'$2y$10$1b2k6Wq7Q9a3nNsMIzBh4e6XlntK8ZV0T8bqcsz1ZK0s3qvp6NCB6',
            ],
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
