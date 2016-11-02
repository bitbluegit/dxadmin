<?php

namespace Framework;

use Exception;

class Router {
    private $_routes;
    private $_controller;
    private $_method;
    private $_params = [];
    private $_urlFragments = [];
    private $_namespace = '\Dextro';
    
    public function __construct()
    {
        $this->_routes = require_once 'app/config/routes-config.php';
        $this->_setUrlFragments();
        $this->_setController();
        $this->_setMethod();
        $this->_setParams();
    }
    
    public function dispatch()
    {
        if(!method_exists($this->_controller, $this->_method)) {
            $this->_controller = $this->_namespace . '\\' . $this->_routes['error'];
            $this->_method = 'index';
        }
        
        call_user_func_array([new $this->_controller, $this->_method], [$this->_params]);            
    }
    
    private function _setUrlFragments()
    {
        $url = $_GET['url'] ?? null;
        
        if(!is_null($url)) {
            $this->_urlFragments = explode('/', filter_var(trim($url, '/'), FILTER_SANITIZE_URL));    
        }
    }
    
    private function _setController()
    {
        if(isset($this->_urlFragments[0])) {
            if(array_key_exists($this->_urlFragments[0], $this->_routes)) {
                $this->_controller = $this->_routes[$this->_urlFragments[0]];
            } else {
                $this->_controller = $this->_routes['error'];
            }            
        } else {
            $this->_controller = $this->_routes['/'];
        }
        
        $this->_controller = $this->_namespace . '\\' . $this->_controller;
    }
    
    private function _setMethod()
    {
        if(isset($this->_urlFragments[1])) {
            $this->_method = lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $this->_urlFragments[1]))));
        } else {
            $this->_method = 'index';
        }
    }
    
    private function _setParams()
    {
        if(count($this->_urlFragments) > 2) {
            $this->_params = array_splice($this->_urlFragments, 2);            
        }
    }
}