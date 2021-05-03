<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Parameters extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'				=> ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
			'code'				=> ['type' => 'VARCHAR', 'constraint' => 20],
			'caption_id'		=> ['type' => 'VARCHAR', 'constraint' => 100],
			'caption_en'		=> ['type' => 'VARCHAR', 'constraint' => 100],
			'default_unit'		=> ['type' => 'VARCHAR', 'constraint' => 10],
			'molecular_mass'	=> ['type' => 'double', 'default' => 0],
			'formula'			=> ['type' => 'VARCHAR', 'constraint' => 255],
			'is_view'			=> ['type' => 'tinyint', 'default' => 0],
			'is_graph'			=> ['type' => 'tinyint', 'default' => 0],
			'sensor_value_id'	=> ['type' => 'int', 'default' => 0],
			'voltage1'			=> ['type' => 'double', 'default' => 0],
			'voltage2'			=> ['type' => 'double', 'default' => 0],
			'concentration1'	=> ['type' => 'double', 'default' => 0],
			'concentration2'	=> ['type' => 'double', 'default' => 0],
			'xtimestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP',
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addKey('code');
		$this->forge->createTable('parameters', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('parameters');
	}
}
