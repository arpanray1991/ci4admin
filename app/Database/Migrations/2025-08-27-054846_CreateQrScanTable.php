<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQrScanTable extends Migration
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
            'qr_data_id' => [ 
	            'type'           => 'INT',
	            'constraint'     => 11,
	            'unsigned'       => true,
                'null'           => true,
	        ],
	        'ip_address' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '50',
	        ],
			'user_agent' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '255',
	        ],
	        'platform' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '100',
	        ],
            'browser' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '100',
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
	    $this->forge->createTable('qr_scan');

        $this->db->query("ALTER TABLE qr_scan MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE qr_scan MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropTable('qr_scan');
    }
}
