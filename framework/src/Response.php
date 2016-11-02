<?php

/**
 * @package Girgit
 * @license MIT
 * @author Pradeep T. <pt21388@gmail.com>
 * @copyright Copyright (c) 2016, Pradeep T.
 *
 * This file is part of the Girgit package. For the full copyright and license
 * information, please view the LICENSE file that was distributed with this source
 * code.
 */

namespace Framework;

use Exception;

class Response
{
    private static $_statusMessages = [
        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        204 => 'No Content',

		// Redirection 3xx
		301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
		
        // Failure 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        409 => 'Conflict',

        // Server Error 5xx
        500 => 'Internal Server Error',
        503 => 'Service Unavailable'
    ];
    private $_type = 'text/html';
    private $_body = '';
    private $_code = 200;
    private $_message = 'OK';
    private $_headers = [];

    public function __construct()
    {
		// nothing here
    }
	
    public function json(array $content = []) : Response
    {
        $this->_type = 'application/json';
        $this->_body = json_encode($content);
		
		return $this;
    }

    public function html($content) : Response
    {
        if(!is_string($content) && !is_numeric($content)) {
            throw new HttpResponseException('Please provide a string for HTML response content');
        }

        $this->_type = 'text/html';
        $this->_body = $content;
		
		return $this;
    }

    public function code(int $code) : Response
    {
        if(!array_key_exists($code, self::$_statusMessages)) {
            throw new HttpResponseException(sprintf("Invalid HTTP status code: %s supplied", $code));
        }

        $this->_code = $code;
        $this->_message = self::$_statusMessages[$code] ?? 'unknown status';
		
		return $this;
    }

    public function headers(array $headers) : Response
    {
        foreach($headers as $name => $value) {
            $this->_headers[(string) $name] = (string) $value;
        }
		
		return $this;
    }

    public function message(string $message) : Response
    {
        $this->_message = $message;
		
		return $this;
    }

	public static function redirect(string $url, int $code = 302)
    {
        if (headers_sent()) {
            throw new Exception('The headers have already been sent.');
        }

        if(!array_key_exists($code, self::$_statusMessages)) {
            throw new HttpResponseException(sprintf("Invalid HTTP status code: %s supplied", $code));
        }

        header(sprintf("HTTP/1.1 %s %s", $code, self::$_statusMessages[$code]));
        header("Location: {$url}");
    }
	
    public function send()
    {
		$this->_sendHeaders();
        echo $this->_body;
    }
	
	private function _sendHeaders()
    {
		if(headers_sent()) {
            throw new Exception('The headers have already been sent.');
        }
		
        header(sprintf("HTTP/1.1 %s %s", $this->_code, $this->_message));
        header(sprintf("Content-Type: %s; charset=UTF-8", $this->_type));

        foreach($this->_headers as $name => $value) {
            header(sprintf("%s: %s", $name, $value));
        }
    }
}