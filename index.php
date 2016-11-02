<?php

namespace Dextro;

class Index
{
	public static function main()
	{
		// import composer autoloader
		require_once __DIR__ . '/vendor/autoload.php';

		// define system configuration constants
		self::_defineSystemConfigurationConstants();
		
		// set error reporting level
		error_reporting(E_ALL);
		
		// display errors while development
		ini_set('display_errors', ENV_DEV_MODE);
		
		// start session
		\Framework\Session::start();
		
		// set default time zone
		date_default_timezone_set(APP_TIMEZONE);
		
		// register top level exception handler
		set_exception_handler(['\Framework\ExceptionHandler', 'catchException']);
		
		// register custom error handler
		//set_error_handler(['\Framework\ErrorHandler', 'catchError']);
		
		// dispatch application request
		(new \Framework\Router)->dispatch();
	}
	
	private static function _defineSystemConfigurationConstants()
	{
		$config = require_once __DIR__ . '/app/config/system-config.php';
		
		foreach($config as $type => $details) {
			foreach($details as $key => $value) {
				define(strtoupper($type . '_' . $key), $value);
			}
		}
	}
}

Index::main();