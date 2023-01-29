<?php
namespace App\Controllers\Back;

class CommonController {

  public function getResetPage()
  {
    require_once './app/views/reset/reset.view.php';
  }
  
  public function getNewPasswordPage()
  {
    require_once './app/views/newPass/newPswd.view.php';
  }
  
  public function getLoginPage()
  {
    require_once './app/views/login/login.view.php';
  }

  public function getConnexion()
  {
    require_once './app/Controllers/Back/Users.php';
  }

  public function getResetController()
  {
    require_once './app/Controllers/Back/ResetPasswordsController.php';
  }
}