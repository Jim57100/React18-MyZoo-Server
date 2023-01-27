<?php
namespace App\Models\DBConnect;

use PDO;
use PDOException;

abstract class DBConnect 
{

  private static $pdo;

  private static function setBdd()
  {
    try {
      self::$pdo = new PDO("mysql:host=localhost; dbname=udemy_myzoo; charset=utf8", "root", "*My5qlJMS57100*");
      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch(PDOException $e) {
      print "Error 500 ! ". $e->getMessage() . "<br/>";
      die();
    }
  }

  protected function getDB() {
    if(self::$pdo == null) {
      self::setBdd();
    }
    return self::$pdo;
  }

  public static function sendJSON($info)
  {
    header("Access-Control-Allow-Origin: *"); //Allow CORS
    header("Content-Type: application/json");
    echo json_encode($info);
  }
}