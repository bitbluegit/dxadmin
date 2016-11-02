<?php

namespace Framework;

use Exception;

/**
 * Class Http Request
 *
 * This class is a simple object oriented layer representing traditional HTTP
 * request. It exposes following public interfaces:
 *
 * @method    String|Array    get       Method for PHP $_GET.
 * @method    String|Array    post      Method for PHP $_POST.
 * @method    String|Array    files     Method for PHP $_FILES.
 */
class Request
{
    private $_get;
    private $_post;
    private $_files;
    
    public function __construct()
    {
        $this->_get = $this->_filter($_GET);
        $this->_post = $this->_filter($_POST);
        $this->_files = $this->_filter($_FILES);
        
        //unset($_GET, $_POST, $_FILES);
    }
    
    public function __call(string $method, array $arguments = [])
    {
        $property = '_' . $method;
        $key = $arguments[0] ?? null;
        
        if(!property_exists(__CLASS__, $property)) {
            throw new Exception('No such request method <b>%s</b>', $method);
        }
        
        if($key === null) {
            return $this->{$property};
        } else {
            return $this->{$property}[$key] ?? null;
        }
    }
    
    public function isAjax() : bool
    {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            return true;
        }

        return false;
    }
    
    private function _filter(array $data) : array
    {
        array_walk_recursive($data, function($item) {
            return htmlspecialchars($item, ENT_COMPAT, 'UTF-8');
        });
        
        return $data;
    }
}