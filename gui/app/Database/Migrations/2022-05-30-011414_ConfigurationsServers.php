<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ConfigurationsServers extends Migration
{
	public function up()
	{
		$data = [
			['name' => 'is_sentto_trusur', 'content' => '1'],
			['name' => 'is_sentto_klhk', 'content' => '1'],
			['name' => 'trusur_api_server', 'content' => 'api.trusur.tech'],
			['name' => 'klhk_api_server', 'content' => 'ispu.menlhk.go.id'],
			['name' => 'trusur_', 'content' => 'ispu.menlhk.go.id'],
			['name' => 'iot_path', 'content' => '/iot/iot/'],
		];
		$this->db->table('configurations')->insertBatch($data);
	}

	public function down()
	{
		$this->db->table('configurations')->where(["name" => "is_psu_restarting"])->delete();
	}
}
