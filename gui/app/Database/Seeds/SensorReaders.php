<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SensorReaders extends Seeder
{
	public function run()
	{
		$this->db->query("TRUNCATE TABLE sensor_readers");
		$data = [
			['mode' => 'labjack', 'sensor_code' => 'ANY', 'baud_rate' => '', 'pins' => '0,1,2,3'],
			['mode' => 'hc', 'sensor_code' => '/dev/ttyUSB0', 'baud_rate' => '9600', 'pins' => ''],
			['mode' => 'metone', 'sensor_code' => '/dev/ttyUSB1', 'baud_rate' => '9600', 'pins' => ''],
			['mode' => 'metone', 'sensor_code' => '/dev/ttyUSB2', 'baud_rate' => '9600', 'pins' => ''],
			['mode' => 'vantagepro2', 'sensor_code' => '/dev/ttyUSB2', 'baud_rate' => '19200', 'pins' => ''],
		];
		$this->db->table('sensor_readers')->insertBatch($data);
	}
}
