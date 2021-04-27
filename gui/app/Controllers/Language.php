<?php

namespace App\Controllers;

class Language extends BaseController
{

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$code = $this->request->uri->getSegment(2);
		$session = session();
		$session->remove('web_lang');
		$session->set('web_lang', $code);
		return redirect()->to($_SERVER['HTTP_REFERER']);
	}
}
