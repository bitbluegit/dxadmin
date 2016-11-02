<?php

namespace Dextro\Domains;

use Framework\Mysql;

class TransactionModel
{
	private $_db = null;
	
	public function __construct()
	{
		$this->_db = new Mysql;
	}
	
	public function getUsers()
	{
		$sql = "SELECT * FROM clg_hat";
		return $this->_db->all($sql);
	}
	
	public function getStdeunt()
	{
		$sql = "SELECT * FROM stduent";
		return $this->_db->all($sql);
	}
}