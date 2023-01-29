<?php 
    ob_start();
?>

<div class="container mt-5">
  <div class="row mt-3 mb-3">
    <div class="col-12 text-center">
      <ul style="list-style-type: none;">
        <li><a href="./contacts" class="btn btn-info">Contacts</a></li>
        <li><a href="./create" class="btn btn-info">Create</a></li>
        <li><a href="./read" class="btn btn-info">Read / Delete</a></li>
        <li><a href="./update" class="btn btn-info">Update</a></li>
      </ul>
    </div>
  </div>
</div>

<?php 
    $content = ob_get_clean();
    require './app/views/commons/template.php';    
?>

