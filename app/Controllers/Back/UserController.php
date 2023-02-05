<?php

namespace App\Controllers\Back;

class UserController {

  public function getSignUpPage() 
  {
    require_once './app/views/signup/signup.view.php';
  }
  
  public function getUserHomePage()
  {
    require_once './app/views/home/homeUser.view.php';
  }
}