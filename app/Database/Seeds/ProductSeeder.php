<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
            	'sku'		=>	'bat',
            	'name'		=>	'Cricket Bat',
                'price'		=>	'100',
            ],
            [
            	'sku'		=>	'ball',
            	'name'		=>	'Cricket Ball',
                'price'		=>	'75',
            ],
        ];
        $this->db->table('products')->insertBatch($data);
    }
}
