<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RestartSchedule extends Migration
{
	public function up()
	{
		$data = [
			['name' => 'restart_schedule', 'content' => ''],
		];
		$this->db->table('configurations')->insertBatch($data);
	}

	public function down()
	{
		$this->db->table('configurations')->where(["name" => "restart_schedule"])->delete();
	}
}
