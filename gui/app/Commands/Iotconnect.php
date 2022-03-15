<?php

namespace App\Commands;

use App\Database\Migrations\Measurements;
use App\Models\m_measurement;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Iotconnect extends BaseCommand
{
	/**
	 * The Command's Group
	 *
	 * @var string
	 */
	protected $group = 'CodeIgniter';

	/**
	 * The Command's Name
	 *
	 * @var string
	 */
	protected $name = 'command:iot_connect';

	/**
	 * The Command's Description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * The Command's Usage
	 *
	 * @var string
	 */
	protected $usage = 'command:iot_connect [arguments] [options]';

	/**
	 * The Command's Arguments
	 *
	 * @var array
	 */
	protected $arguments = [];

	/**
	 * The Command's Options
	 *
	 * @var array
	 */
	protected $options = [];

	/**
	 * Actually execute a command.
	 *
	 * @param array $params
	 */
	public function run(array $params)
	{
		try {
			$client = \Config\Services::curlrequest([
				'timeout' => 3
			]);

		} catch (\Throwable $th) {
			throw $th;
		}
	}

	public function getMeasurements(){
		$Measurement = new m_measurement();
		$day = date('Y-m-d');
		$i = (int) date('i');
		$ii = ($i < 30 ? 00 : 30);
		$timeGroup = "{$day} ".date('H').":{$ii}:00";
		if($i == 0 || $i == 30){
			$measurements = $Measurement->select('parameters.p_type, parameters.code, measurements.value')
			->where('DATE_FORMAT(time_group,"%Y-%m-%d")',$timeGroup)
			->get();
			foreach ($measurements as $value) {
				
			}
		}
	}

	public function isAbnormal($measurement){
		$bakuMutu = $this->getBakuMutu($measurement->code);
		if($measurement->value > $bakuMutu || $measurement->value <= 0) return true;
		return false;
	}

	public function getBakuMutu($code){
		switch ($code) {
			case 'pm10':
				$bakuMutu = 150;
				break;
			case 'pm25':
				$bakuMutu = 65;
				break;
			case 'no2':
				$bakuMutu = 400;
				break;
			case 'so2':
				$bakuMutu = 900;
				break;
			case 'co':
				$bakuMutu = 30000;
				break;
			case 'o3':
				$bakuMutu = 235;
				break;
			case 'no2':
				$bakuMutu = 400;
				break;
			case 'hc':
				$bakuMutu = 160;
				break;
			
			default:
				$bakuMutu = 0;
				break;
		}
		return $bakuMutu;
	}

}
