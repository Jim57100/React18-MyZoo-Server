<?php 
    ob_start();
    include_once './app/helpers/session_helper.php';
?>
<div class="container d-flex mt-5 justify-content-center align-items-center flex-column" style="height: 70vh; min-width: 100%">

<div class="row">
    <div class="row mb-3" style="height: 75px;">
        <?php flash('register') ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
    <h1 class="header">Please Sign up</h1>
    </div>
</div>
<div class="row d-flex justify-content-center align-items-center flex-column">
    <div class="col-12 text-center">
        <form method="post" class="form-group" action="<?= URL ?>back/common/connexion">
            <input type="hidden" name="type" value="register">
            <input type="text" name="usersName" 
            placeholder="Full name..." class="form-control mb-3">
            <input type="text" name="usersEmail" 
            placeholder="Email..." class="form-control mb-3">
            <input type="text" name="usersUid" 
            placeholder="Username..." class="form-control mb-3">
            <input type="password" name="usersPwd" 
            placeholder="Password..." class="form-control mb-3">
            <input type="password" name="pwdRepeat" 
            placeholder="Repeat password" class="form-control mb-3">
            <button type="submit" name="submit" class="btn btn-info mb-3">Sign Up</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        Already have an account? Please 
        <a href="<?= URL ?>back/common/login">Sign in</a>
    </div>
</div>


</div>
    

   

<?php 
    $content = ob_get_clean();
    require './app/views/commons/template.php';    
?>