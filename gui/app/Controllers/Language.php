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
		session()->remove('web_lang');
		session()->set('web_lang', $code);
		return redirect()->to(base_url());
	}
}
