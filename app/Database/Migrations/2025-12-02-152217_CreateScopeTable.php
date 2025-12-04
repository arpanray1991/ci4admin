<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateScopeTable extends Migration
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
	        'scope_type' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '100',
	        ],
			'functionality' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '255',
	        ],
	        'status' => [
	            'type'       => 'INT',
	            'constraint' => 1,
                'default'    => 1,
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
	    $this->forge->createTable('scopes');

        $this->db->query("ALTER TABLE scopes MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE scopes MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropTable('scopes');
    }
}
