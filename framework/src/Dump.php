<?php

namespace Framework;

// dumps data for debugging
class Dump
{
    // mimick var_dump()
    public static function v($data) 
    {
        echo '<pre>' . var_dump($data) . '</pre>';
    }

    // mimicks print_r()
    public static function p($data) 
    {
        echo '<pre>' . print_r($data, TRUE) . '</pre>';
    }
    
    public static function type($var)
    {
        echo gettype($var);
    }
    
}