<?php
use App\Controllers\Back\AdminController;
use App\Controllers\Front\APIController;
//http://localhost/...
//https://www.jimprojects.ovh/projects/php/MyZoo/...
define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));


$apiController = new APIController();
$adminController = new AdminController();

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
          // case 'families':
          //   $apiController->getFamilies();
          //   break;

          // case 'continents':
          //   $apiController->getContinents();
          //   break;
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
              $adminController->getPageLogin();
              if(!empty($_GET[$url[2]])) {
                switch ($url[2]) {
                  case 'login.php':
                    $adminController->getPageLogin();
                    break;
                  case 'create-new-password.php':
                    $adminController->getPageNewPassword();
                    break;
                  case 'reset-password.php':
                    $adminController->getPageResetPassword();
                    break;
                  case 'Users.php':
                    $adminController->getUsers();
                  break;
                  default: throw new Exception("Erreur 404 ! La page n'existe pas !");
                  break;
                }
              }
            break;
          case 'user' : $adminController->getPageSignUp(); break;
              
          
          
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

