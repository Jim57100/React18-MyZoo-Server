<?php 
  use App\Controllers\Back\ContactController;
  $controller = new ContactController();
  $contacts = $controller->getData();
  ob_start();
  /* <?= $contacts  ?> a mettre dans html si affichage en React */
  ?>
<div class="container text-center mt-5 mb-5">
  <div class="row">
    <div class="col-12">
      <table>
        <tr>
          <th>Id</th>
          <th>Gender</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Message</th>
        </tr>
        <?php foreach ($contacts as $contact): ?>
          <tr>
            <td><?= $contact['id'] ?></td>
            <td><?= $contact['gender'] ?></td>
            <td><?= $contact['firstName'] ?></td>
            <td><?= $contact['lastName'] ?></td>
            <td><?= $contact['email'] ?></td>
            <td><?= $contact['message'] ?></td>
          </tr>
        <?php endforeach; ?> 
      </table>
    </div>
  </div>
</div>

<?php 
    $content = ob_get_clean();
    require './app/views/commons/template.php';    
?>






