<?php 
    ob_start();
    include_once './app/helpers/session_helper.php';
?>
<div class="container d-flex mt-5 justify-content-center align-items-center flex-column" style="height: 70vh; min-width: 100%">
    <div class="row" style="height: 75px;">
        <div class="col-12 text-center">
            <?php flash('login') ?>
        </div>
    </div>    
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="header">Please Login</h1>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 text-center">
            <form method="post" action="<?= URL ?>back/admin/connexion" class="form-group">
                <input type="hidden" name="type" value="login">
                <input type="text" 
                    name="name/email" 
                    placeholder="Username or Email..." 
                    class="form-control mb-3" 
                    required
                >
                <input 
                    type="password" 
                    name="usersPwd" 
                    placeholder="Password..." 
                    class="form-control mb-3" 
                    required
                >
                <button type="submit" name="submit" class="btn btn-primary mb-3 btn-lg">Log In</button>
            </form>
            <div class="form-sub-msg"><a href="<?= URL ?>back/admin/forgotten">Forgotten Password?</a></div>
        </div>
    </div>
</div>
    
<?php 
    $content = ob_get_clean();
    require './app/views/commons/template.php';    
?>