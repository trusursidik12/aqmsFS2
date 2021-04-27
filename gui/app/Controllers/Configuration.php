<?php

namespace App\Controllers;

class Configuration extends BaseController
{

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data['__modulename'] = 'Configurations'; /* Title */
		$data['__routename'] = 'configuration'; /* Route for check menu */
		echo view("dashboard/v_dashboard", $data);
	}
}
