<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToProducts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('products', [
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1, // 1 = Active, 2 = Inactive
                'null'       => false,
                'after'      => 'price' // place after price column
            ],
        ]);

        $this->db->query("ALTER TABLE products MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE products MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropColumn('products', 'status');
    }
}
