<?php 
    ob_start();
    include_once './app/helpers/session_helper.php';
?>
<div class="container d-flex mt-5 justify-content-center align-items-center flex-column" style="height: 70vh; min-width: 100%">

<div class="row">
    <div class="row mb-3" style="height: 110px;">
        <?php flash('register') ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
    <h1 class="header">Please Signup</h1>
    </div>
</div>
<div class="row">
    <div class="col-12 d-flex flex-column">
    <form method="post" action="<?= URL ?>back/common/connexion">
        <input type="hidden" name="type" value="register">
        <input type="text" name="usersName" 
        placeholder="Full name...">
        <input type="text" name="usersEmail" 
        placeholder="Email...">
        <input type="text" name="usersUid" 
        placeholder="Username...">
        <input type="password" name="usersPwd" 
        placeholder="Password...">
        <input type="password" name="pwdRepeat" 
        placeholder="Repeat password">
        <button type="submit" name="submit">Sign Up</button>
    </form>
    </div>
</div>


</div>
    

   

<?php 
    $content = ob_get_clean();
    require './app/views/commons/template.php';    
?>