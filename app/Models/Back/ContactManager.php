<?php
namespace App\Models\Back;
use PDO;
use App\Models\DBConnect\DBConnect;

class ContactManager extends DBConnect 
{
  public function __construct() {
    
  }

  public function getAllContacts()
  {
    $req="SELECT * FROM contacts";
    $stmt = $this->getDB()->prepare($req);
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    // $data = json_encode($contacts); //pour envoyer vers React au besoin
    return $contacts;
  }
  
  public function deleteContact($id)
  {
    $req = "DELETE FROM contact WHERE id = :id";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
  }
}