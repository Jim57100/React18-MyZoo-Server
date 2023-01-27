<?php

namespace App\Controllers\Back;

class AdminController {

  public function __construct() {
    
  }

  public function getPageIndex()
  {
    require_once './app/views/login/index.php';
  }

  public function getPageLogin()
  {
    require_once './app/views/login/login.php';
  }

  public function getPageSignUp() 
  {
    require_once './app/views/login/signup.php';
  }

  public function getPageNewPassword()
  {
    require_once './app/views/login/create-new-password.php';
  }

  public function getPageResetPassword()
  {
    require_once './app/views/login/reset-password.php';
  }

  public function getUsers()
  {
    require_once './app/Controllers/Back/Users.php';
  }
}