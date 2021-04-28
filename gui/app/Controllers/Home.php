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
		$data['__modulename'] = 'Dashboard'; /* Title */
		$data['__routename'] = 'dashboard'; /* Route for check menu */
		echo view("dashboard/v_dashboard2", $data);
	}
}
