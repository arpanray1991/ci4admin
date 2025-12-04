<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUiBookmarkTable extends Migration
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
	        'admin_user_id' => [
	            'type'       => 'INT',
	            'constraint' => '10',
                'unsigned'       => true,
	        ],
	        'grid_slug' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '100',
	        ],
	        'hide_fields' => [
	            'type'       => 'VARCHAR',
	            'constraint' => '255',
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
	    $this->forge->createTable('ui_bookmark');

        $this->db->query("ALTER TABLE ui_bookmark MODIFY updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE ui_bookmark MODIFY created_at DATETIME DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        $this->forge->dropTable('ui_bookmark');
    }
}
