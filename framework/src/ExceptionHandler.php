<?php

namespace Framework;

use Exception;

class ExceptionHandler
{
	public static function catchException(Exception $e)
	{
		echo 'Whoops!!';
		\Framework\Dump::p($e->getCode());
		\Framework\Dump::p($e->getFile());
		\Framework\Dump::p($e->getLine());
		\Framework\Dump::p($e->getMessage());
		\Framework\Dump::p($e->getTrace());
		exit(-1);
	}
}