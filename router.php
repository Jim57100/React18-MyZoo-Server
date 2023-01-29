<?php
use App\Controllers\Front\APIController;
use App\Controllers\Back\UserController;
use App\Controllers\Back\AdminController;
//http://localhost/...
//https://www.jimprojects.ovh/projects/php/MyZoo/...
define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));


$apiController = new APIController();
$adminController = new AdminController();
$userController = new UserController();

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
              case 'login': $adminController->getLoginPage(); break;
              case 'connexion': $adminController->getConnexion(); break;
              case 'home': $adminController->getAdminHomePage(); break;
              case 'forgotten': $adminController->getForgottenPage(); break;
              case 'reset': $adminController->getPageNewPassword(); break;
              case 'signup': $adminController->getSignUpPage(); break;
              default : throw new Exception("Erreur 404 ! La page n'existe pas !");
            }
              
              // if(!empty($_GET[$url[2]])) {
              //   switch ($url[2]) {
              //     case 'login.php':
              //       $adminController->getPageLogin();
              //       break;
              //     case 'create-new-password.php':
              //       $adminController->getPageNewPassword();
              //       break;
              //     case 'reset-password.php':
              //       $adminController->getPageResetPassword();
              //       break;
              //     case 'Users.php':
              //       $adminController->getUsers();
              //     break;
              //     default: throw new Exception("Erreur 404 ! La page n'existe pas !");
              //     break;
              //   }
              // }
            break;
          case 'user' : 
            switch($url[2]) {
             case 'login': $userController->getPageSignUp(); break;
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

