<?php
use App\Controllers\Back\UserController;
use App\Controllers\Front\APIController;
use App\Controllers\Back\AdminController;
use App\Controllers\Back\CommonController;
//http://localhost/...
//https://www.jimprojects.ovh/projects/php/MyZoo/...
define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));


$apiController = new APIController();
$adminController = new AdminController();
$userController = new UserController();
$commonController = new CommonController();

//router
try {
  if(empty($_GET['page'])) {
    throw new Exception("Erreur 404 ! La page n'existe pas !");
  } else {
    $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
    // echo "<pre>";
    // print_r($url);
    // echo "</pre>";
    if(empty($url[0]) || empty($url[1])) throw new Exception("Erreur 404 ! La page n'existe pas !");
    switch($url[0]) {
      case "front" : switch ($url[1]) {
        case 'animals':
          $apiController->getAnimals();
          break;
        case 'animal':
          if(empty($url[2])) {
            throw new Exception("Erreur 404 ! La page n'existe pas !");
          } else {
            $apiController->getAnimal($url[2]);
          }
          break;
        case 'shows':
          $apiController->getShows();
          break;
        case 'show':
          if(empty($url[2])) {
            throw new Exception("Erreur 404 ! La page n'existe pas !");
          } else {
            $apiController->getShow($url[2]);
          } 
          break;
        case 'sendMessage' : 
          $apiController->sendMessage();
        break;
      default: throw new Exception("Erreur 404 ! La page n'existe pas !");
      break;
      }
      break;
      case "back" : 
        switch ($url[1]) {
          case 'admin':
            switch($url[2]) {
              // case 'login': $adminController->getLoginPage(); break;          
              case 'home': $adminController->getAdminHomePage(); break;
              case 'contacts' : $adminController->getContactPage(); break;
              // case 'signup': $adminController->getSignUpPage(); break;
              default : throw new Exception("Erreur 404 ! La page n'existe pas !");
            }
              
            break;
          case 'user' : 
            switch($url[2]) {
             case 'signup': $userController->getSignUpPage(); break;
             case 'home': $userController->getUserHomePage(); break;
             default : throw new Exception("Erreur 404 ! La page n'existe pas !");
            }
              
          case 'common' :
            switch($url[2]) {
              case 'login': $commonController->getLoginPage(); break;
              case 'connexion': $commonController->getConnexion(); break;
              case 'reset': $commonController->getResetPage(); break;
              case 'resetCtrl': $commonController->getResetPasswordsController(); break;
              case 'new': $commonController->getNewPasswordPage(); break;
              default : throw new Exception("Erreur 404 ! La page n'existe pas !");
             }
          default : throw new Exception("Erreur 404 ! La page n'existe pas !");
        }
       
      break;
      default : throw new Exception("Erreur 404 ! La page n'existe pas !");
    }
  }
}
catch(Exception $e) {
  $msg = $e->getMessage();
  echo $msg;
}

