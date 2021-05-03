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
			$data = $this->measurement_log->whereIn('parameter_id', function (BaseBuilder $builder) {
				return $builder->select('id')->from('parameters')->where('is_view', 1);
			})->join('parameters', 'measurement_logs.parameter_id = parameters.id', 'left')->findAll();
		} catch (Exception $e) {
			$data = null;
		}
		return $this->response->setJson($data);
	}
}
