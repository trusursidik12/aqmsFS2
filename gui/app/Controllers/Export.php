<?php

namespace App\Controllers;

class Export extends BaseController
{

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data['__modulename'] = 'Exports'; /* Title */
		$data['__routename'] = 'export'; /* Route for check menu */
		echo view("export/v_index", $data);
	}
}
