<?php

use App\Models\DBConnect\DBConnect;

class AdminManager extends DBConnect
{

  private function getPasswordUser($login)
  {
    $req = 'SELECT * FROM administrateur WHERE login = :login';
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":login", $login, PDO::PARAM_STR);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->CloseCursor();
    return $admin['password'];
  }

  public function isConnectionValid($login, $password)
  {
    $passwordBD = $this->getPasswordUser($login);
    return password_verify($password, $passwordBD);
  }
}
