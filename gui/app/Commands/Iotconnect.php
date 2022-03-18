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
			$baseIotServer = "http://api.localhost:8000/";
			$client = \Config\Services::curlrequest([
				'timeout' => 3
			]);
			$url = $baseIotServer."?";
			while (true) {
				$problems = $this->getMeasurements();
				if(count($problems) > 0){
					foreach ($problems as $key => $problem) {
						$url.="code[{$key}]={$problem['code']}&";
						$url.="content[{$key}]={$problem['content']}&";
					}
					// Send Device Status Problem
					$requestToServer = $client->get($url,[]);
					$response = $requestToServer->getJSON();

					// Check if command exists
					if($response['hasCommand']){
						$commands = $response['commands'];
						foreach ($commands as $key => $command) {
						}
					}
				}
				sleep(30);
			}
			

		} catch (\Throwable $th) {
			throw $th;
		}
	}

	public function getMeasurements(){
		$Measurement = new m_measurement();
		$i = (int) date('i');
		if($i == 0 || $i == 30){
			$problems = [];
			$dateStart = date('Y-m-d H:i:s',strtotime('-30 min'));
			$dateEnd = date('Y-m-d H:i:s');
			$whereRaw = "time_group >= '{$dateStart}' AND time_group <= '{$dateEnd}'";
			$measurements = $Measurement->select('parameters.p_type, parameters.code, measurements.value')
			->where($whereRaw)
			->findAll();
			foreach ($measurements as $measurement) {
				$isAbnormal = $this->isAbnormal($measurement);
				if($isAbnormal['abnormal']){
					$problems[] = $isAbnormal['code'];
				}
			}
			return $problems;
		}
		return [];

	}

	public function isAbnormal($measurement){
		$bakuMutu = $this->getBakuMutu($measurement->code);
		if($measurement->value > $bakuMutu){
			$data = [
				'abnormal' => true,
				'code' => $this->getCodeZeroValue($measurement->code).".1",
			];
		}elseif($measurement->value <= 0){
			$data = [
				'abnormal' => true,
				'code' => $this->getCodeZeroValue($measurement->code),
			];
		}else{
			$data['abnormal'] = false;
			$data['code'] = '200';
		}
		return $data;
	}

	/**
	 * Hardcode baku mutu 
	 *
	 * @param [type] $code
	 * @return void
	 */
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
			case 'hc':
				$bakuMutu = 160;
				break;
			
			default:
				$bakuMutu = 0;
				break;
		}
		return $bakuMutu;
	}

	public function getCodeZeroValue($code){
		switch ($code) {
			case 'pm10':
				$code = "422";
				break;
			case 'pm25':
				$code = "421";
				break;
			case 'no2':
				$code = "431";
				break;
			case 'so2':
				$code = "434";
				break;
			case 'co':
				$code = "433";
				break;
			case 'o3':
				$code = "432";
				break;
			case 'hc':
				$code = "435";
				break;
			case 'pressure':
				$code = "440";
				break;
			
			default:
				$code = "200";
				break;
		}
		return $code;
	}
}
