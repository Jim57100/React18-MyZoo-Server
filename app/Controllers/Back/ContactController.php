<?php
namespace App\Controllers\Back;

use App\Models\Back\ContactManager;


class ContactController 
{
  private $contactManager;

  public function __construct()
  {
    $this->contactManager = new ContactManager();
  }

  public function getData () {
    $data = $this->contactManager->getAllContacts();
    return $data;
  }

  public function getPageContact() {
    require_once '.app/views/contact/contact.view.php';
  }
}
