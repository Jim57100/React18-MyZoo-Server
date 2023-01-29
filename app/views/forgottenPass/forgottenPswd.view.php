<?php 
    ob_start();
    include_once './app/helpers/session_helper.php';
?>
<div class="container d-flex mt-5 justify-content-center align-items-center flex-column" style="height: 80vh; min-width: 100%">
    <div class="row" style="height: 110px;">
        <div class="col-12">
            <?php flash('reset') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h1 class="header">Reset Password</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="post" action="./controllers/ResetPasswords.php" class="form-group">
                <input type="hidden" name="type" value="send" />
                <input type="text" name="usersEmail" 
                placeholder="Email..." class="form-control" required>
                <button type="submit" name="submit" class="btn btn-primary btm-lg">Change Password</button>
            </form>
        </div>
    </div>
</div>

<?php 
    $content = ob_get_clean();
    require './app/views/commons/template.php';    
?>
