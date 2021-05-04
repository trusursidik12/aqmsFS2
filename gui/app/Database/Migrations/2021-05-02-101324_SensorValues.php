<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SensorValues extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'				=> ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
			'sensor_reader_id'	=> ['type' => 'INT', 'default' => 0],
			'pin'				=> ['type' => 'INT', 'default' => 0],
			'value'				=> ['type' => 'VARCHAR', 'default' => '', 'constraint' => 255],
			"xtimestamp DATETIME NOT NULL DEFAULT (datetime('now','localtime'))",
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addKey('sensor_reader_id');
		$this->forge->addKey('pin');
		$this->forge->createTable('sensor_values', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('sensor_values');
	}
}
