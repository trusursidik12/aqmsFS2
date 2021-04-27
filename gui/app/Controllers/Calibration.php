<?php

namespace App\Controllers;

class Calibration extends BaseController
{

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data['__modulename'] = 'Calibrations'; /* Title */
		$data['__routename'] = 'calibration'; /* Route for check menu */
		echo view("dashboard/v_dashboard", $data);
	}
}
