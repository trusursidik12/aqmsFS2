<?php

namespace App\Commands;

use App\Models\m_configuration;
use App\Models\m_measurement;
use App\Models\m_measurement_log;
use App\Models\m_parameter;
use App\Models\m_sensor_value;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Sentdata extends BaseCommand
{
	/**
	 * The Command's Group
	 *
	 * @var string
	 */
	protected $group = 'CodeIgniter';
	protected $parameters;
	protected $sensor_values;
	protected $measurement_logs;
	protected $configurations;
	protected $lastPutData;

	public function __construct()
	{
		$this->parameters =  new m_parameter();
		$this->sensor_values =  new m_sensor_value();
		$this->measurement_logs =  new m_measurement_log();
		$this->configurations =  new m_configuration();
		$this->measurements =  new m_measurement();
		$this->lastPutData = "0000-00-00 00:00";
	}
	/**
	 * The Command's Name
	 *
	 * @var string
	 */
	protected $name = 'command:sentdata';

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
	protected $usage = 'command:name [arguments] [options]';

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
		$server_host = "103.247.11.149";
		$measurement_ids = "";
		$arr["id_stasiun"] = @$this->configurations->where("name", "id_stasiun")->findAll()[0]->content;
		foreach ($this->parameters->where("is_view", 1)->findAll() as $parameter) {
			$measurement = $this->measurements->where(["parameter_id" => $parameter->id, "is_sent_cloud" => 0])->orderBy("id")->findAll()[0];
			$arr["waktu"] = $measurement->xtimestamp;
			$arr[$parameter->code] = $measurement->value;
			$measurement_ids .= $measurement->id . ",";
		}
		$measurement_ids = substr($measurement_ids, 0, -1);

		$data = json_encode($arr);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://" . $server_host . "/server_side/api/put_data.php",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_USERPWD => "KLHK-2019:Project2016-2019",
			CURLOPT_POSTFIELDS => $data,
			CURLOPT_HTTPHEADER => array(
				"Api-Key: VHJ1c3VyVW5nZ3VsVGVrbnVzYV9wVA==",
				"cache-control: no-cache",
				"content-type: application/json"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			if (strpos(" " . $response, "success") > 0) {
				$this->measurements->where("id IN (" . $measurement_ids . ")")->set(["is_sent_cloud" => 1, "sent_cloud_at" => date("Y-m-d H:i:s")])->update();
			} else {
				echo $response;
			}
		}
	}
}
