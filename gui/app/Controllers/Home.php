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
		echo view('v_header');
		echo view('v_menu');
		echo view('v_home');
		echo view('v_footer');
	}
}
