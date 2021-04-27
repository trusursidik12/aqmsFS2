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
		echo view("calibration/v_index", $data);
	}
	public function zero($id = null)
	{
		if (is_null($id)) {
			return redirect()->to(base_url('calibrations'));
		}
		$data['__modulename'] = 'Zero Calibration'; /* Title */
		$data['__routename'] = 'calibration'; /* Route for check menu */
		echo view("calibration/v_zero", $data);
	}
	public function span($id = null)
	{
		if (is_null($id)) {
			return redirect()->to(base_url('calibrations'));
		}
		$data['__modulename'] = 'Span Calibrations'; /* Title */
		$data['__routename'] = 'calibration'; /* Route for check menu */
		echo view("calibration/v_span", $data);
	}
}
