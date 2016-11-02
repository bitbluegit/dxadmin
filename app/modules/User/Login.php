<?php

namespace Dextro\Modules\User;

use Framework\Controller;

class Login extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		echo 'inside user\login';
	}
}