<?php
namespace App\Models\Front;

use PDO;
use App\Models\DBConnect\DBConnect;

class APIManager extends DBConnect
{

  public function getDBAnimals() 
  {
    $req  = "SELECT * 
    FROM animals a
    INNER JOIN families f on f.Id_families = a.Id_families
    INNER JOIN threats t on t.Id_threats = a.Id_threats
    INNER JOIN news n on n.Id_animals = a.Id_animals
    INNER JOIN is_on i on i.Id_animals = a.Id_animals
    INNER JOIN continents c on c.Id_continents = i.Id_continents
    ";
    
    $stmt = $this->getDB()->prepare($req);
    $stmt->execute();
    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $animals;
  }

  public function getDBAnimal($id) 
  {
    $req  = "SELECT * 
    FROM animals a
    INNER JOIN families f on f.Id_families = a.Id_families
    INNER JOIN threats t on t.Id_threats = a.Id_threats
    INNER JOIN news n on n.Id_animals = a.Id_animals
    INNER JOIN is_on i on i.Id_animals = a.Id_animals
    INNER JOIN continents c on c.Id_continents = i.Id_continents
    WHERE a.Id_animals = :idAnimal
    ";
    
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":idAnimal", $id, PDO::PARAM_INT);
    $stmt->execute();
    $animal = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $animal;
  }

  public function getDBshows() 
  {
    $req  = "SELECT * FROM shows";
    $stmt = $this->getDB()->prepare($req);
    $stmt->execute();
    $shows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $shows;
  }

  public function getShow($id) 
  {
    $req = "SELECT * FROM shows s WHERE s.Id_animals = :id";
    $stmt = $this->getDB()->prepare($req);
    $stmt->execute();
    $show = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $show;
  }

  public function getDBFamilies()
  {
    $req = "SELECT * FROM families";
    $stmt = $this->getDB()->prepare($req);
    $stmt->execute();
    $families = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $families;
  }

  public function getDBFamily($id)
  {
    $req = "SELECT * FROM families f WHERE f.Id_families = :id";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $family = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $family;
  }

  public function setDBFamily($id)
  {
    echo "family is set";
  }

  public function getDBContinents()
  {
    $req = "SELECT * FROM continents";
    $stmt = $this->getDB()->prepare($req);
    $stmt->execute();
    $continents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $continents;
  }

  public function getDBContinent($id)
  {
    $req = "SELECT * FROM continents c WHERE c.Id_continents = :id";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $family = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $family;
  }

  public function getDBNews() 
  {
    $req = "SELECT * FROM news";
    $stmt = $this->getDB()->prepare($req);
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $news;
  }

  public function getDBNew($id) 
  {
    $req = "SELECT * FROM news n WHERE n.Id_animals = :id";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $new = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $new;
  }

  public function getDBThreats() 
  {
    $req = "SELECT * FROM threats";
    $stmt = $this->getDB()->prepare($req);
    $stmt->execute();
    $threats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $threats;
  }

  public function getDBThreat($id)
  {
    $req = "SELECT * FROM threats t WHERE t.Id_animals = :id";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $family = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $family;
  }

  public function setDBContact($gender, $firstName, $lastName, $email, $message, $newsletter) {
    
    $firstName = htmlspecialchars($firstName);
    $lastName = htmlspecialchars($lastName);
    $email = htmlspecialchars($email);
    $message = htmlspecialchars($message);

    $req = "INSERT INTO contacts (gender, firstName, lastName, email, message, newsletter) VALUES (:gender, :firstName, :lastName, :email, :message, :newsletter)";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":gender", $gender, PDO::PARAM_STR);
    $stmt->bindValue(":firstName", $firstName, PDO::PARAM_STR);
    $stmt->bindValue(":lastName", $lastName, PDO::PARAM_STR);
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    $stmt->bindValue(":message", $message, PDO::PARAM_STR);
    $stmt->bindValue(":newsletter", $newsletter, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
  }
}