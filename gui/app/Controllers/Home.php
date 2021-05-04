<?php

namespace App\Controllers;

use App\Models\m_parameter;

class Home extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->parameter = new m_parameter();
	}
	public function index()
	{
		$template = $this->request->getGet('theme');
		$data['__modulename'] = 'Dashboard'; /* Title */
		$data['__routename'] = 'dashboard'; /* Route for check menu */
		$data['gases'] = $this->parameter->where(['is_view' => 1, 'type' => 'gas'])->findAll();
		$data['particulates'] = $this->parameter->where(['is_view' => 1, 'type' => 'particulate'])->findAll();
		$data['weathers'] = $this->parameter->where(['is_view' => 1, 'type' => 'weather'])->findAll();
		if ($template == 1) {
			echo view("dashboard/v_dashboard", $data);
		} else {
			echo view("dashboard/v_dashboard2", $data);
		}
	}
}
