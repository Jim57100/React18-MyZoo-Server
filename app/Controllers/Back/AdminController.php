<?php

namespace App\Controllers\Back;

class AdminController {

  public function __construct() {
    
  }

  // public function getLoginPage()
  // {
  //   require_once './app/views/login/login.php';
  // }

  public function getAdminHomePage()
  {
    require_once './app/views/home/homeAdmin.view.php';
  }
  
  //Only if needed
  // public function getSignUpPage()
  // {
  //   require_once './app/views/signup/signup.view.php';
  // }

  public function getContactPage()
  {
    require_once './app/views/contacts/contacts.view.php';
  }
}