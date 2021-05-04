<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\m_configuration;
use App\Models\m_measurement_log;
use App\Models\m_parameter;
use CodeIgniter\Database\BaseBuilder;
use Exception;

class Measurementlog extends BaseController
{
	public function __construct()
	{
		$this->measurement_log = new m_measurement_log();
		$this->parameter = new m_parameter();
		$this->configuration = new m_configuration();
	}
	public function index()
	{
		$data['config'] = [
			'pump_state' => @$this->configuration->where(['name' => 'pump_state'])->get()->getFirstRow()->content,
			'pump_last' => @$this->configuration->where(['name' => 'pump_last'])->get()->getFirstRow()->content,
			'pump_interval' => @$this->configuration->where(['name' => 'pump_interval'])->get()->getFirstRow()->content,
			'now' => date('Y-m-d H:i:s'),
		];
		try {
			$measurementlog_id = $this->measurement_log->selectMax('id')->groupBy('parameter_id');
			$data['logs'] = $this->measurement_log->whereIn('measurement_logs.id', function (BaseBuilder $builder) use ($measurementlog_id) {
				return $measurementlog_id;
			})->join('parameters', 'measurement_logs.parameter_id = parameters.id AND parameters.is_view = 1', 'left')->groupBy('parameter_id')->findAll();
		} catch (Exception $e) {
			echo $e->getMessage();
			$data = null;
		}
		return $this->response->setJson($data);
	}
}
