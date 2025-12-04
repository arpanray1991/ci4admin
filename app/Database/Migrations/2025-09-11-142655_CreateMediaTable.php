<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMediaTable extends Migration
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
	        'file_name' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '255',
	        ],
			'file_path' => [
	            'type'       => 'TEXT',
	        ],
	        'mime_type' => [
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
	    $this->forge->createTable('media');

        $this->db->query("ALTER TABLE media MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE media MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropTable('media');
    }
}
