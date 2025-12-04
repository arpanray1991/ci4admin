<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminUsersTable extends Migration
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
	        'firstname' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '100',
	        ],
	        'lastname' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '100',
	        ],
	        'username' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '100',
	        ],
	        'password' => [
	        	'type'			=>	'VARCHAR',
	        	'constraint'	=>	'255',
	        ],
	        'email' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '150',
	        ],
	        'created_at' => [
	            'type' => 'DATETIME',
	            'null' => true,
	        ],
	    ]);
	    $this->forge->addKey('id', true);
	    $this->forge->createTable('adminusers');
    }

    public function down()
    {
        $this->forge->dropTable('adminusers');
    }
}
