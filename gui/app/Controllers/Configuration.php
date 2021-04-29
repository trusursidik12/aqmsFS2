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
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			return $this->saving_edit();
		}
		$data['__modulename'] = 'Configurations'; /* Title */
		$data['__routename'] = 'configuration'; /* Route for check menu */
		echo view("configuration/v_index", $data);
	}
	public function saving_edit()
	{
		$data['success'] = true;
		$data['message'] = 'Configuration has changed';
		$data['data'] = @$_POST;
		return json_encode($data);
	}
}
