<?php

namespace App\Controllers;

use App\Models\m_calibration;
use App\Models\m_configuration;
use Exception;

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
	public function datatable(){
		try{
			$calibrationLogs = $this->calibrations
				->select('sensor_readers.sensor_code, calibrations.*')
				// ->groupBy('started_at')
				->join('sensor_readers','sensor_readers.id = calibrations.sensor_reader_id')
				->orderBy('calibrations.id','desc')->findAll(5);
			$data['draw'] = @$this->request->getGet('draw') ?  (int) $this->request->getGet('draw') : 1;
			$data['recordsTotal'] = 0;
			$data['recordsFiltered'] = 0;
			$data['data'] = $calibrationLogs;
			return $this->response->setJson($data);
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
	function array2csv(array &$array){
		if (count($array) == 0) {
			return null;
		}
		ob_start();
		$df = fopen("php://output", 'w');
		fputcsv($df, array_keys(reset($array)));
		foreach ($array as $row) {
			fputcsv($df, $row);
		}
		fclose($df);
		return ob_get_clean();
	}
	function download_send_headers($filename) {
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		// header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");
	
		// force download  
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
	
		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$filename}");
		header("Content-Transfer-Encoding: binary");
	}
	public function export(){
		try{
			$started_at = $this->request->getGet('started_at');
			$end_at = $this->request->getGet('end_at');
			$whereRaw = "1=1";
			$whereRaw .= "";
		}catch(Exception $e){

		}
	}
}
