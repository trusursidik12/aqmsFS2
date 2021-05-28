<?php

namespace App\Controllers;

use App\Models\m_configuration;
use App\Models\m_measurement;

class Export extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->measurement = new m_measurement();
		$this->configuration = new m_configuration();
	}
	public function index()
	{
		$tGroups = $this->measurement->groupBy('time_group')->orderBy('time_group', 'DESC')->findAll(100);
		$parameters = [];
		foreach ($tGroups as $key => $tGroup) {
			@$parameters[$key]['waktu'] = $tGroup->time_group;
			@$parameters[$key]['no2'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 1])->findAll()[0]->value;
			@$parameters[$key]['o3'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 2])->findAll()[0]->value;
			@$parameters[$key]['co'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 3])->findAll()[0]->value;
			@$parameters[$key]['so2'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 4])->findAll()[0]->value;
			@$parameters[$key]['hc'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 5])->findAll()[0]->value;
			@$parameters[$key]['pm25'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 12])->findAll()[0]->value;
			@$parameters[$key]['pm10'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 14])->findAll()[0]->value;
			@$parameters[$key]['pressure'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 18])->findAll()[0]->value;
			@$parameters[$key]['wd'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 19])->findAll()[0]->value;
			@$parameters[$key]['ws'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 20])->findAll()[0]->value;
			@$parameters[$key]['temperature'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 21])->findAll()[0]->value;
			@$parameters[$key]['humidity'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 22])->findAll()[0]->value;
			@$parameters[$key]['sr'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 23])->findAll()[0]->value;
			@$parameters[$key]['rain_intensity'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 24])->findAll()[0]->value;
		}
		$data['parameters'] = $parameters;
		$data['__modulename'] = 'Exports'; /* Title */
		$data['__routename'] = 'export'; /* Route for check menu */
		echo view("export/v_index", $data);
	}
	public function datatable()
	{
		// Configuration
		$id_station = @$this->configuration->where('name', 'id_stasiun')->get()->getFirstRow()->content;
		/*
			Filter
		*/
		$begindate = $this->request->getGet('begindate');
		$enddate = $this->request->getGet('enddate');
		if (isset($begindate) && isset($enddate)) { // Filter Date
			$where = "DATE_FORMAT(time_group, '%Y-%m-%d') >= '{$begindate}' ";
			$where .= "AND DATE_FORMAT(time_group, '%Y-%m-%d') <= '{$enddate}' ";
			$tGroups = $this->measurement->where($where)->groupBy('time_group')->orderBy('time_group', 'DESC')->findAll(100);
		} else {
			$tGroups = $this->measurement->groupBy('time_group')->orderBy('time_group', 'DESC')->findAll(100);
		}
		$parameters = [];
		foreach ($tGroups as $key => $tGroup) {
			@$parameters[$key]['id_stasiun'] = $id_station;
			@$parameters[$key]['waktu'] = $tGroup->time_group;
			@$parameters[$key]['no2'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 1])->findAll()[0]->value;
			@$parameters[$key]['o3'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 2])->findAll()[0]->value;
			@$parameters[$key]['co'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 3])->findAll()[0]->value;
			@$parameters[$key]['so2'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 4])->findAll()[0]->value;
			@$parameters[$key]['hc'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 5])->findAll()[0]->value;
			@$parameters[$key]['pm25'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 12])->findAll()[0]->value;
			@$parameters[$key]['pm10'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 14])->findAll()[0]->value;
			@$parameters[$key]['pressure'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 18])->findAll()[0]->value;
			@$parameters[$key]['wd'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 19])->findAll()[0]->value;
			@$parameters[$key]['ws'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 20])->findAll()[0]->value;
			@$parameters[$key]['temperature'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 21])->findAll()[0]->value;
			@$parameters[$key]['humidity'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 22])->findAll()[0]->value;
			@$parameters[$key]['sr'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 23])->findAll()[0]->value;
			@$parameters[$key]['rain_intensity'] = $this->measurement->where(['time_group' => $tGroup->time_group, 'parameter_id' => 24])->findAll()[0]->value;
		}
		$record = (isset($key) ? $key + 1 : 0);
		$data['draw'] = @$this->request->getGet('draw');
		$data['recordsTotal'] = $record;
		$data['recordsFiltered'] = $record;
		$data['data'] = $parameters;
		return json_encode($data);
	}
}
