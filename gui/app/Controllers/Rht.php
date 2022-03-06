<?php

namespace App\Controllers;

use App\Models\m_sensor_value;
use App\Models\m_configuration;

class Rht extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->sensor_values = new m_sensor_value();
		$this->configurations = new m_configuration();
	}

	public function index()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			return $this->saving_edit();
		}
		$data['__this'] = $this;
		$data['__modulename'] = 'RHT'; /* Title */
		$data['__routename'] = 'rht'; /* Route for check menu */
		echo view("rht/v_index", $data);
	}


	public function sensor_values()
	{
		$analyzer = @$this->sensor_values->where("value LIKE '%FS2_ANALYZER%'")->findAll()[0]->value;
		$pump = @$this->sensor_values->where("value LIKE '%FS2_PUMP%'")->findAll()[0]->value;
		$psu = @$this->sensor_values->where("value LIKE '%FS2_PSU%'")->findAll()[0]->value;
		$membrasens_0 = @$this->sensor_values->where("value LIKE '%FS2_MEMBRASENS%'")->findAll()[0]->value;
		$membrasens_1 = @$this->sensor_values->where("value LIKE '%FS2_MEMBRASENS%'")->findAll()[1]->value;
		$analyzers = explode(";", $analyzer);
		$num_analyzers = count($analyzers);
		$data["vacuum"] = round((-0.0009765625 * $analyzers[$num_analyzers - 6]) + 1, 6);
		$data["temp_analyzer"] = $analyzers[$num_analyzers - 5] * 1;
		$data["rh_analyzer"] = $analyzers[$num_analyzers - 4] * 1;
		$data["temp_sensor"] = $analyzers[$num_analyzers - 3] * 1;
		$data["rh_sensor"]  = $analyzers[$num_analyzers - 2] * 1;
		$data["pressure"] = round((0.001953125 * explode(";", $pump)[3]) + 0, 6);
		$data["temp_pump"] = explode(";", $pump)[4] * 1;
		$data["rh_pump"] = explode(";", $pump)[5] * 1;
		$data["temp_psu"] = explode(";", $psu)[1] * 1;
		$data["rh_psu"] = explode(";", $psu)[2] * 1;
		$data["con_membrasens_0_0"] = explode(";", $membrasens_0)[1] * 1;
		$data["con_membrasens_0_1"] = explode(";", $membrasens_0)[2] * 1;
		$data["con_membrasens_0_2"] = explode(";", $membrasens_0)[3] * 1;
		$data["con_membrasens_0_3"] = explode(";", $membrasens_0)[4] * 1;
		$data["volt_membrasens_0_0"] = explode(";", $membrasens_0)[5] * 1;
		$data["volt_membrasens_0_1"] = explode(";", $membrasens_0)[6] * 1;
		$data["volt_membrasens_0_2"] = explode(";", $membrasens_0)[7] * 1;
		$data["volt_membrasens_0_3"] = explode(";", $membrasens_0)[8] * 1;
		$data["temp_membrasens_0_0"] = explode(";", $membrasens_0)[9] * 1;
		$data["temp_membrasens_0_1"] = explode(";", $membrasens_0)[10] * 1;
		$data["temp_membrasens_0_2"] = explode(";", $membrasens_0)[11] * 1;
		$data["temp_membrasens_0_3"] = explode(";", $membrasens_0)[12] * 1;
		$data["con_membrasens_1_0"] = explode(";", $membrasens_1)[1] * 1;
		$data["con_membrasens_1_1"] = explode(";", $membrasens_1)[2] * 1;
		$data["con_membrasens_1_2"] = explode(";", $membrasens_1)[3] * 1;
		$data["con_membrasens_1_3"] = explode(";", $membrasens_1)[4] * 1;
		$data["volt_membrasens_1_0"] = explode(";", $membrasens_1)[5] * 1;
		$data["volt_membrasens_1_1"] = explode(";", $membrasens_1)[6] * 1;
		$data["volt_membrasens_1_2"] = explode(";", $membrasens_1)[7] * 1;
		$data["volt_membrasens_1_3"] = explode(";", $membrasens_1)[8] * 1;
		$data["temp_membrasens_1_0"] = explode(";", $membrasens_1)[9] * 1;
		$data["temp_membrasens_1_1"] = explode(";", $membrasens_1)[10] * 1;
		$data["temp_membrasens_1_2"] = explode(";", $membrasens_1)[11] * 1;
		$data["temp_membrasens_1_3"] = explode(";", $membrasens_1)[12] * 1;

		echo json_encode($data);
	}

	public function savingSetSpan($board, $port, $span)
	{
		$sensor_reader_id = @$this->sensor_values->where("value LIKE '%FS2_MEMBRASENS%'")->findAll()[$board]->sensor_reader_id;
		if ($sensor_reader_id > 0) {
			$configuration_id = @$this->configurations->where('name', 'setSpan')->first()->id;
			if ($configuration_id > 0)
				$this->configuration->set('content', $sensor_reader_id . ";" . $port . ";" . $span)->where('name', 'setSpan')->update();
			else
				$this->configuration->save(["name" => "setSpan", "content" => $sensor_reader_id . ";" . $port . ";" . $span]);

			echo json_encode(["response" => "OK", "board" => $board, "sensor_reader_id" => $sensor_reader_id, "port" => $port, "span" => $span]);
		} else
			echo json_encode(["response" => "Error", "board" => $board, "port" => $port, "span" => $span]);
	}
}
