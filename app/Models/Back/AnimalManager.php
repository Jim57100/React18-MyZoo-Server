<?php

use App\Models\DBConnect\DBConnect;

class AnimalManager extends DBConnect
{
  public function getAnimals()
  {
    $req = "SELECT * FROM animal";
    $stmt = $this->getDB()->prepare($req);
    $stmt->execute();
    $animal = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $animal;
  }

  public function deleteDBAnimal($id)
  {
    $req = "DELETE FROM animal WHERE animal_id = :id";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
  }

  public function deleteDBAnimalContinent($id)
  {
    $req = "DELETE FROM animal_continent WHERE animal_id = :id";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
  }

  public function countAnimals($id)
  {
    $req = "SELECT COUNT(*) AS 'nb' 
    FROM animal a
    INNER JOIN famille f 
    ON f.famille_id = a.animal_id
    WHERE a.animal_id = :id
    ";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $result['nb'];
  }

  public function updateAnimal($id, $label, $description)
  {
    $req = "UPDATE animal SET animal_nom = :name, animal_description = :description
    WHERE animal_id = :id";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->bindValue(":name", $label, PDO::PARAM_STR);
    $stmt->bindValue(":description", $description, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
  }

  public function createAnimal($name, $description, $image, $famille)
  {
    $req = "INSERT INTO animal (animal_nom, animal_description, animal_image, famille_id)
    values (:name, :description, :image, :famille)
    ";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":name", $name, PDO::PARAM_STR);
    $stmt->bindValue(":description", $description, PDO::PARAM_STR);
    $stmt->bindValue(":image", $image, PDO::PARAM_STR);
    $stmt->bindValue(":famille", $famille, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    return $this->getDB()->lastInsertId();
  }
}
