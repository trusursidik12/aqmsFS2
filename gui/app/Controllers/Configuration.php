<?php

namespace App\Controllers;

use App\Models\m_configuration;
use App\Models\m_sensor_reader;

class Configuration extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->configuration = new m_configuration();
		$this->sensor_reader = new m_sensor_reader();
	}
	public function index()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			return $this->saving_edit();
		}
		$data['__this'] = $this;
		$data['__modulename'] = 'Configurations'; /* Title */
		$data['__routename'] = 'configuration'; /* Route for check menu */
		$data['sensor_readers'] = $this->sensor_reader->findALL();
		echo view("configuration/v_index", $data);
	}

	public function saving_edit()
	{
		$ports = $this->request->getPost('sensor_code');
		$parameters = $this->request->getPost('driver');
		$baudrates = $this->request->getPost('baud_rate');
		foreach ($ports as $key => $port) {
			$data['driver'] = $parameters[$key];
			$data['baud_rate'] = $baudrates[$key];
			$data['sensor_code'] = $ports[$key];
			$this->sensor_reader->update($key, $data);
		}
		$this->configuration->set('content', $this->request->getPost('nama_stasiun'))->where('name', 'nama_stasiun')->update();
		$this->configuration->set('content', $this->request->getPost('id_stasiun'))->where('name', 'id_stasiun')->update();
		$this->configuration->set('content', $this->request->getPost('city'))->where('name', 'city')->update();
		$this->configuration->set('content', $this->request->getPost('province'))->where('name', 'province')->update();
		$this->configuration->set('content', $this->request->getPost('address'))->where('name', 'address')->update();
		$this->configuration->set('content', $this->request->getPost('latitude'))->where('name', 'latitude')->update();
		$this->configuration->set('content', $this->request->getPost('longitude'))->where('name', 'longitude')->update();
		$this->configuration->set('content', $this->request->getPost('pump_interval'))->where('name', 'pump_interval')->update();
		$this->configuration->set('content', $this->request->getPost('data_interval'))->where('name', 'data_interval')->update();
		$this->configuration->set('content', $this->request->getPost('graph_interval'))->where('name', 'graph_interval')->update();
		$this->configuration->set('content', $this->request->getPost('pump_speed'))->where('name', 'pump_speed')->update();
		$data['success'] = true;
		$data['message'] = 'Configuration has changed';
		$data['data'] = @$_POST;
		return json_encode($data);
	}
}
