<?php

namespace Framework;

use PDO;
use Exception;
use PDOException;

/**
 * Class MySql
 *
 * Rather than working with native extension, we will use PDO. It provides a database
 * abstraction layer so that we do not need learn vendor specific data-access
 * techniques.
 */
class Mysql
{
	/**
	 * @var  Resource
	 *
	 * Holds a PDO connection instance
	 */
	private $_instance = null;
	
	/**
	 * Class Constructor
	 *
	 * Creates a new PDO instance.
	 */
	public function __construct()
	{
		$dsn = 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_NAME . ';charset=utf8';
		
		try {
			$this->_instance = new PDO($dsn, MYSQL_USER, MYSQL_PSWD, [PDO::ATTR_PERSISTENT => MYSQL_PERSIST]);
			$this->_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			$this->closeConnection();
			throw new Exception('Could not connect to database:<br>' . $e->getMessage());
		}
	}
	
	/**
	 * Executes DML statements such as insert, update, and delete queries.
	 *
	 * @param    String        $sql       The sql query to execute.
	 * @param    Null|Array    $params    Array of parameters to bind.
	 *
	 * @return   Null|Integer    The number of affected rows
	 */
	public function execute(string $sql, $params = null)
	{
		$numberOfAffectedRows = null;
		
		try {
			$preparedStatement = $this->_instance->prepare($sql);
			$preparedStatement->execute($params);
			$numberOfAffectedRows = $preparedStatement->rowCount();
		} catch(PDOException $e) {
			$this->closeConnection();
			throw new Exception('Could not execute query:<br>' . $e->getMessage());
		}
		
		return $numberOfAffectedRows;
	}
	
	/**
	 * Retrieves a complete result set as an array.
	 *
	 * @param    String        $sql           The sql query to execute.
	 * @param    Null|Array    $params        Array of parameters to bind.
	 *
	 * @return   Null|Array   An associative array of records.
	 */
	public function all(string $sql, $params = null)
	{
		$resultSet = null;
		
		try {
			$preparedStatement = $this->_instance->prepare($sql);
			$preparedStatement->execute($params);
			$resultSet = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			throw new Exception('Could not fetch records:<br>' . $e->getMessage());
		}
		
		return $resultSet;
	}
	
	/**
	 * Retrieves a single row of records.
	 *
	 * @param    String        $sql           The sql query to execute.
	 * @param    Null|Array    $params        Array of parameters to bind.
	 *
	 * @return   Null|Array   An associative array representing a row of records.
	 */
	public function one(string $sql, $params = null)
	{
		$resultSet = null;
		
		try {
			$preparedStatement = $this->_instance->prepare($sql);
			$preparedStatement->execute($params);
			$resultSet = $preparedStatement->fetch(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
			throw new Exception('Could not fetch a record:<br>' . $e->getMessage());
		}
		
		return $resultSet;
	}
	
	/**
	 * Retrieves the first column value from a single row of record.
	 *
	 * @param    String        $sql           The sql query to execute.
	 * @param    Null|Array    $params        Array of parameters to bind.
	 *
	 * @return   Null|String   The first column value from the result.
	 */
	public function column(string $sql, $params = null)
	{
		$columnValue = null;
		
		try {
			$preparedStatement = $this->_instance->prepare($sql);
			$preparedStatement->execute($params);
			$resultSet = $preparedStatement->fetch(PDO::FETCH_ASSOC);
			$columnValue = $resultSet[0];
		} catch(PDOException $e) {
			throw new Exception('Could not fetch a record:<br>' . $e->getMessage());
		}
		
		return $columnValue;
	}
	
	/**
	 * Returns the auto-increment id of the last inserted record.
	 *
	 * @return    Null/Integer    The last insert id.
	 */
	public function lastId()
	{
		return $this->_instance->lastInsertId();
	}
	
	/**
	 * Returns an instance of PDO.
	 *
	 * @return  Resource  The PDO connection object.
	 */
	public function getInstance() : PDO
	{
		return $this->_instance;
	}
	
	/**
	 * Closes the database instance.
	 */
	public function closeConnection()
	{
		$this->_instance = null;
	}
}