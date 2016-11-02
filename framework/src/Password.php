<?php

namespace Framework;

class Password
{
    // $pswd: the password for hashing
    public static function hash(string $pswd) : string 
    {
        return password_hash($pswd, PASSWORD_DEFAULT);
    }
    
    // $pswd: user supplied password, $hash: hashed password saved in database
    public static function verify(string $pswd, string $hash) : bool 
    {
        return password_verify($pswd, $hash);
    }
    
}