<?php

namespace App\Controllers;

use App\Models\m_calibration;

class Calibration extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		$this->calibrations = new m_calibration();
	}
	public function index()
	{
		$data['__modulename'] = 'Calibrations'; /* Title */
		$data['__routename'] = 'calibration'; /* Route for check menu */
		$data['__this'] = $this;
		echo view("calibrations/v_index", $data);
	}
}
