<?php

namespace Framework;

use Exception;

class ExceptionHandler
{
	public static function catchException(Exception $e)
	{
		self::_renderErrors($e->getFile(), $e->getLine(), $e->getMessage(), $e->getTraceAsString());
		exit(-1);
	}
	
	private static function _renderErrors($file, $line, $mssg, $trace)
	{
		require_once 'templates/exception.php';
	}
}