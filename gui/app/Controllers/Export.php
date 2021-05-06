<?php

namespace App\Controllers;

use App\Models\m_measurement;

class Export extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->measurement = new m_measurement();
	}
	public function index()
	{
		$tGroups = $this->measurement->groupBy('time_group')->findAll();
		$parameters = [];
		foreach ($tGroups as $key => $tGroup) {
			$parameters[$key]['waktu'] = $tGroup->time_group;
			$parameters[$key]['no2'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 1])->findAll()[0]->value;
			$parameters[$key]['o3'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 2])->findAll()[0]->value;
			$parameters[$key]['co'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 3])->findAll()[0]->value;
			$parameters[$key]['so2'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 4])->findAll()[0]->value;
			$parameters[$key]['hc'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 5])->findAll()[0]->value;
			$parameters[$key]['pm25'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 12])->findAll()[0]->value;
			$parameters[$key]['pm10'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 14])->findAll()[0]->value;
			$parameters[$key]['pressure'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 18])->findAll()[0]->value;
			$parameters[$key]['wd'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 19])->findAll()[0]->value;
			$parameters[$key]['ws'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 20])->findAll()[0]->value;
			$parameters[$key]['temperature'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 21])->findAll()[0]->value;
			$parameters[$key]['humidity'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 22])->findAll()[0]->value;
			$parameters[$key]['sr'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 23])->findAll()[0]->value;
			$parameters[$key]['rain_intensity'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 24])->findAll()[0]->value;
		}
		$data['parameters'] = $parameters;
		$data['__modulename'] = 'Exports'; /* Title */
		$data['__routename'] = 'export'; /* Route for check menu */
		echo view("export/v_index", $data);
	}
}
