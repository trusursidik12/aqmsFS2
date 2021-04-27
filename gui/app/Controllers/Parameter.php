<?php

namespace App\Controllers;

class Parameter extends BaseController
{

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data['__modulename'] = 'Parameters'; /* Title */
		$data['__routename'] = 'parameter'; /* Route for check menu */
		echo view("parameter/v_index", $data);
	}
}
