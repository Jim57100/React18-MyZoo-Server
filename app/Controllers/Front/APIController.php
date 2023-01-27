<?php
namespace App\Controllers\Front;

use App\Models\Front\APIManager;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\DBConnect\DBConnect;

class APIController 
{

  private $apiManager;
  private $mail;

  public function __construct() 
  {
    $this->apiManager = new APIManager();

  }

  /**
   * function name: formatDataRowsAnimals
   *  Used to reformat multiple data from animals table to one array per animal
   * @param [type] $rows
   * @return void
   */
  public function formatDataRowsAnimals($rows)
  {
    $tab = [];
    foreach ($rows as $row) { //une ligne d'un animal donné
      if(!array_key_exists($row['Id_animals'], $tab)) {
        $tab[$row['Id_animals']] = [
          'id' => $row['Id_animals'],
          'name' => $row['animal_name'],
          'description' => $row['animal_description'],
          'thumbnail' => URL."public/images/thumbnails/".$row['animal_thumbnail'],
          'image' => URL."public/images/animal_image/".$row['animal_image'],
          'main_title' => $row['animal_main_title'],
          'second_title' => $row['animal_second_title'],
          'fact' => $row['animal_facts'],
          'threat' => [
            'id' => $row['Id_threats'],
            'priority' => $row['threat_priority'],
            'description' => $row['threat_description']
          ],
          'family' => [
            'id' => $row['Id_families'],
            'name' => $row['family_name'],
            'description' => $row['family_description']
          ]
        ];
      }
      $tab[$row['Id_animals']]['continents'][] = [
        "id" => $row['Id_continents'],
        "name" => $row['continents_name']
      ];
      $tab[$row['Id_animals']]['news'][] = [
        "id" => $row['Id_news'],
        "title" => $row['new_title'],
        "description" => $row['new_description'],
        "image" => URL."public/images/news_image/".$row['new_img']
      ];
    }

    return $tab;
    /* On veut ça :
      [animal] => [
        [Id_animals]
        [animal_name] 
        [animal_description]
        [animal_thumbnail]
        [animal_image] 
        [animal_main_title]
        [animal_second_title]
        [Id_threats] 
      ]
      [threat] => [
        [Id_threats]
        [threat_priority]
        [threat_description]
      ]
      [family] => [  Sous-niveau
        [Id_families],
        [family_name],
        [family_description]
      ]
      [continent] => [ Sous-niveau avec 1 ligne par continent sur lequel l'animal est présent
        [
          [Id_continents],
          [continents_name]
        ]
        
      ]
    */
  }
  
  public function getAnimals() 
  {
    $animals = $this->apiManager->getDBAnimals();
    $tabResult = $this->formatDataRowsAnimals($animals);
    //Uncomment below for maintenance
    // echo "<pre>";
    // print_r($tabResult);
    // echo "</pre>";
    DBConnect::sendJSON($tabResult);
  }

  public function getAnimal($id) 
  {
    $animal = $this->apiManager->getDBAnimal($id);
    $tabResult = $this->formatDataRowsAnimals($animal);
    //Uncomment below for maintenance
    // echo "<pre>";
    // print_r($tabResult);
    // echo "</pre>";
    DBConnect::sendJSON($tabResult);
  }

  public function getShows()
  {
    $shows = $this->apiManager->getDBShows();
    // echo "<pre>";
    // print_r($tabResult);
    // echo "</pre>";
    DBConnect::sendJSON($shows);
  }

  public function getShow ($id) 
  {
    $show = $this->apiManager->getDBAnimal($id);
    $tabResult = $this->formatDataRowsAnimals($show);
    // echo "<pre>";
    // print_r($tabResult);
    // echo "</pre>";
    DBConnect::sendJSON($tabResult);
  }

  public function getFamilies()
  {
    $families = $this->apiManager->getDBFamilies();
    DBConnect::sendJSON($families);
  }

  public function getContinents()
  {
    $continents = $this->apiManager->getDBContinents();
    DBConnect::sendJSON($continents);
  }

  public function getThreats()
  {
    $threats = $this->apiManager->getDBThreats();
    DBConnect::sendJSON($threats);
  }

  public function getNews()
  {
    $news = $this->apiManager->getDBNews();
    DBConnect::sendJSON($news);
  }

  public function sendMessage() 
  {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length");
    
    $rest_json = file_get_contents("php://input"); //json from react
    
    $_POST = json_decode($rest_json, true); 
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $this->mail = new PHPMailer();
    $this->mail->isSMTP();
    $this->mail->Host = 'smtp.mailtrap.io';
    $this->mail->SMTPAuth = true;
    $this->mail->Port = 2525;
    $this->mail->Username = '3552d65bee6f20';
    $this->mail->Password = '9d0ced55afb500';
    
    //Can Send Email Now
    $subject = $_POST['lastName']." has sent you a message from the website";
    $message = "<p>".htmlspecialchars($_POST['message'])."</p>";

    $this->mail->setFrom($_POST['email']);
    $this->mail->addReplyTo($_POST['email'], 'MyZoo');
    $this->mail->addAddress('contact@myzoo.com');
    $this->mail->isHTML(true);
    $this->mail->Subject = $subject;
    $this->mail->Body = $message;
    $this->mail->send();
  }

    //for maintenance only
    // $returnedMessage = [
    //   'gender' => $_POST['gender'],
    //   'firstName' => $_POST['firstName'],
    //   'lastName' => $_POST['lastName'],
    //   'from' => $_POST['email'],
    //   'message' => $_POST['message']
    // ];
    // echo json_encode($returnedMessage);
    
    //Set contact in DB
    $this->apiManager->setDBContact(
      $_POST['gender'], 
      $_POST['firstName'], 
      $_POST['lastName'], 
      $_POST['email'], 
      $_POST['message'], 
      $_POST['newsletter']
    );
    
  }

}
