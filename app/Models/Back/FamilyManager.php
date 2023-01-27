<?php

use App\Models\DBConnect\DBConnect;

class FamilyManager extends DBConnect
{
  public function getFamily()
  {
    $req = "SELECT * FROM famille";
    $stmt = $this->getDB()->prepare($req);
    $stmt->execute();
    $family = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $family;
  }

  public function deleteDBFamily($id)
  {
    $req = "DELETE FROM famille WHERE famille_id = :id";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
  }

  public function countAnimals($id)
  {
    $req = "SELECT COUNT(*) AS 'nb' 
    FROM famille f 
    INNER JOIN animal a 
    ON a.famille_id = f.famille_id
    WHERE f.famille_id = :id
    ";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result['nb'];
  }

  public function updateFamily($idFamily, $label, $description)
  {
    $req = "UPDATE famille SET famille_libelle = :libelle, famille_description = :description
    WHERE famille_id = :id";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $idFamily, PDO::PARAM_INT);
    $stmt->bindValue(":libelle", $label, PDO::PARAM_STR);
    $stmt->bindValue(":description", $description, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
  }

  public function createFamily($label, $description)
  {
    $req = "INSERT INTO famille (famille_libelle, famille_description)
    values (:libelle, :description)
    ";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":libelle", $label, PDO::PARAM_STR);
    $stmt->bindValue(":description", $description, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    return $this->getDB()->lastInsertId();
  }
}
