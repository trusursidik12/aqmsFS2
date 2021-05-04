<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SensorValueLogs extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'				=> ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
			'sensor_value_id'	=> ['type' => 'INT', 'default' => 0],
			'value'				=> ['type' => 'VARCHAR', 'default' => '', 'constraint' => 255],
			"xtimestamp DATETIME NOT NULL DEFAULT (datetime('now','localtime'))",
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addKey('sensor_value_id');
		$this->forge->createTable('sensor_value_logs', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('sensor_value_logs');
	}
}
