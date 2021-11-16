<?php

namespace App\Controllers;

use App\Models\m_calibration;
use App\Models\m_configuration;

class Calibration extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		$this->calibrations = new m_calibration();
		$this->configuration = new m_configuration();
	}

	public function index()
	{
		$data['__modulename'] = 'Calibrations'; /* Title */
		$data['__routename'] = 'calibration'; /* Route for check menu */
		$data['__this'] = $this;
		echo view("calibrations/v_index", $data);
	}

	public function zero_calibration_starting($calibrator_name, $zerocal_duration)
	{
		$this->configuration->where(["name" => "calibrator_name"])->set(["content" => $calibrator_name])->update();
		$this->configuration->where(["name" => "zerocal_duration"])->set(["content" => $zerocal_duration])->update();
		$this->configuration->where(["name" => "is_zerocal"])->set(["content" => 1])->update();
		echo json_encode(["status" => "ok"]);
	}

	public function force_stop_zero_calibration()
	{
		$this->configuration->where(["name" => "zerocal_finished_at"])->set(["content" => ""])->update();
		echo json_encode(["status" => "ok"]);
	}

	public function get_data()
	{
		$data["zerocal_started_at"] = @$this->configuration->where(["name" => "zerocal_started_at"])->find()[0]->content;
		$data["zerocal_finished_at"] = @$this->configuration->where(["name" => "zerocal_finished_at"])->find()[0]->content;
		$remaining = strtotime($data["zerocal_finished_at"]) - strtotime(date("Y-m-d H:i:s"));
		if ($remaining < 0 || $data["zerocal_finished_at"] == "")
			$data["remaining"] = "";
		else
			$data["remaining"] = date("i:s", $remaining);
		$data["is_zerocalibrating"] = 0;
		if ($data["zerocal_started_at"] != "" && $data["zerocal_started_at"] != "")
			$data["is_zerocalibrating"] = 1;
		echo json_encode($data);
	}
}
