<?php
class AuthController{
    function __construct() {} 

    public function login($route)
    {
        $message = "You've been logged in successfully";
        return header("Location: $route");
    }
}

?>