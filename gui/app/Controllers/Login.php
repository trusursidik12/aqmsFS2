<?php

namespace App\Controllers;

class Login extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->password = "qweasd";
	}

	public function index()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			return $this->login_action();
		}
		$data['__this'] = $this;
		$data['__modulename'] = 'Login'; /* Title */
		$data['__routename'] = 'login'; /* Route for check menu */
		echo view("v_login", $data);
	}

	public function login_action()
	{
		$url_direction = $this->request->getPost('url_direction');
		$login = $this->request->getPost('login');
		$password = $this->request->getPost('password');
		if ($password == $this->password) {
			$data['success'] = true;
			$data['message'] = 'OK';
		} else {
			$data['success'] = false;
			$data['message'] = 'Wrong Password';
		}
		return json_encode($data);
	}
}
