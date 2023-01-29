<?php 
    ob_start();
    include_once './app/helpers/session_helper.php';
?>
<div class="container d-flex justify-content-center align-items-center flex-column" style="height: 80vh; min-width: 100%">
    <div class="row" style="height: 75px;">
        <div class="col-12">
            <?php flash('reset') ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="header">Reset Password</h1>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <form method="post" action="<?= URL ?>back/common/resetCtrl" class="form-group">
                <input type="hidden" name="type" value="send" />
                <input type="text" name="usersEmail" 
                placeholder="Email..." class="form-control mb-3" required>
                <button type="submit" name="submit" class="btn btn-primary btm-lg">Change Password</button>
            </form>
        </div>
    </div>
</div>

<?php 
    $content = ob_get_clean();
    require './app/views/commons/template.php';    
?>
