<?php

namespace App\Controllers\Back;

class AdminController {

  public function __construct() {
    
  }

  public function getLoginPage()
  {
   
    require_once './app/views/login/login.php';
  }

  public function getPageSignUp() 
  {
    require_once './app/views/login/signup.php';
  }
  
  public function getConnexion()
  {
    require_once './app/Controllers/Back/Users.php';
  }
  
  public function getAdminHomePage()
  {
    require_once './app/views/home/homeAdmin.view.php';
  }
  
  public function getForgottenPage()
  {
    require_once './app/views/forgottenPass/forgottenPswd.view.php';
  }
  
    public function getPageNewPassword()
    {
      require_once './app/views/newPass/newPswd.view.php';
    }

    public function getSignUpPage()
    {
      require_once './app/views/signup/signup.view.php';
    }
}