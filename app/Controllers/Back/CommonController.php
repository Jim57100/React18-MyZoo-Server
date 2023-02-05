<?php
namespace App\Controllers\Back;

class CommonController {
  
  public function getLoginPage()
  {
    require_once './app/views/login/login.view.php';
  }

  public function getConnexion()
  {
    require_once './app/Controllers/Back/Users.php';
  }

  public function getResetPage()
  {
    require_once './app/views/reset/reset.view.php';
  }

  public function getResetPasswordsController()
  {
    require_once './app/Controllers/Back/ResetPasswordsController.php';
  }

  public function getNewPasswordPage()
  {
    require_once './app/views/newPass/newPswd.view.php';
  }
}