<?php

namespace Framework;

use Framework\Link;
use Framework\Session;
use Framework\Request;
use Framework\Response;

class Controller
{
	protected $view = [];
	protected $data = [];
	
	protected function __construct(bool $checkLogin = false)
	{
		$this->request = new Request();
		$this->response = new Response();
		
		if($checkLogin) {
			if(!Session::exists('login') || !Session::userAgent()) {
				Link::sendTo('Login');
			}
		}
	}
	
	protected function output()
	{
		extract($this->data);
		unset($this->data);
		ob_start();
		
		foreach($this->view as $page) {
			include_once 'app/templates/' . $page . '.php';
		}
		
		$output = ob_get_contents();
		ob_end_clean();
		
		return $output;
	}
}