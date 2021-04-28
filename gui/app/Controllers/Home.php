<?php

namespace App\Controllers;

class Home extends BaseController
{

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$template = $this->request->getGet('theme');
		$data['__modulename'] = 'Dashboard'; /* Title */
		$data['__routename'] = 'dashboard'; /* Route for check menu */
		if ($template == 1) {
			echo view("dashboard/v_dashboard", $data);
		} else {
			echo view("dashboard/v_dashboard2", $data);
		}
	}
}
