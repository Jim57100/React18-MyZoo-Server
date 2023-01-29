<?php

namespace App\Controllers\Back;

class UserController {

  public function __construct() {
    
  }

  public function getPageSignUp() 
  {
   
    require_once './app/views/login/signup.php';
  }

  public function getPageLogin()
  {
    require_once './app/views/login/login.php';
  }
  
  public function getPageHomeUser()
  {
    require_once './app/views/home/homeUser.view.php';
  }
}