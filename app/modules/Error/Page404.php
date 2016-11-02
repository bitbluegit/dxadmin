<?php

namespace Dextro\Modules\Error;

use Framework\Controller;
use Framework\Http\Response;

class Page404 extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->view = ['error/404'];
		(new Response)->html($this->output())->code(404)->send();
	}
}