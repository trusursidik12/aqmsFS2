<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\m_measurement_log;
use CodeIgniter\Database\BaseBuilder;
use Exception;

class Measurementlog extends BaseController
{
	public function __construct()
	{
		$this->measurement_log = new m_measurement_log();
	}
	public function index()
	{
		try {
			$measurementlog_id = $this->measurement_log->selectMax('id')->groupBy('parameter_id');
			$data = $this->measurement_log->whereIn('measurement_logs.id', function (BaseBuilder $builder) use ($measurementlog_id) {
				return $measurementlog_id;
			})->join('parameters', 'measurement_logs.parameter_id = parameters.id AND parameters.is_view = 1', 'left')->groupBy('parameter_id')->findAll();
		} catch (Exception $e) {
			echo $e->getMessage();
			$data = null;
		}
		return $this->response->setJson($data);
	}
}
