<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQrDataTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
	        'id' => [
	            'type'           => 'INT',
	            'constraint'     => 11,
	            'unsigned'       => true,
	            'auto_increment' => true,
	        ],
            'user_id' => [
	            'type'           => 'INT',
	            'constraint'     => 11,
	            'unsigned'       => true,
                'null'           => true,
	        ],
	        'qr_text' => [
	            'type'       => 'TEXT',
	        ],
			'qr_hash' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '255',
	        ],
	        'image_url' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '255',
	        ],
			'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1, // 1 = Active, 2 = Inactive
                'null'       => false,
            ],
	        'created_at' => [
	            'type' => 'DATETIME',
	            'null' => true,
	        ],
            'updated_at' => [
	            'type' => 'DATETIME',
	            'null' => true,
	        ],
	    ]);
	    $this->forge->addKey('id', true);
	    $this->forge->createTable('qr_data');

        $this->db->query("ALTER TABLE qr_data MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE qr_data MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropTable('qr_data');
    }
}
