<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAdminusersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('adminusers', [
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1, // 1 = Active, 2 = Inactive
                'null'       => false,
                'after'      => 'email', // place after price column
            ],
            'user_scope' => [
                'type'  => 'INT',
                'constraint' => 2,
                'null'  => false,
            ],
            'updated_at' => [
	            'type' => 'DATETIME',
	            'null' => true,
	        ],
        ]);

        $this->db->query("ALTER TABLE adminusers MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE adminusers MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropColumn('adminusers', 'status');
    }
}
