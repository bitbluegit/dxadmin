<?php

namespace Framework;

class Token
{
    //generate session level token
    public static function generate() : string 
    {
        $token = md5(uniqid(rand(), TRUE));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }
    
    //check if token exist in the session, things are fine else return false
    public static function isMatched() : bool 
    {
        if(isset($_SESSION['csrf_token'])
		   && isset($_POST['csrf_token'])
		   && ($_SESSION['csrf_token'] == $_POST['csrf_token'])
		) {
			return true;
		}
        
        return false;
    }
}
