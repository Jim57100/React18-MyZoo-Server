
<?php 
    include_once 'header.php';
    include_once './app/helpers/session_helper.php';
?>
    <div class="container text-center w-50" style="height: 80vh;">
        <h1 class="header mt-3 mb-3">Reset Password</h1>
        <?php flash('reset') ?>
        <form class="form-group" method="post" action="./controllers/ResetPasswords.php">
            <input type="hidden" name="type" value="send" />
            <input type="text" name="usersEmail" 
            placeholder="Email..." class="form-control">
            <button type="submit" name="submit">Change Password</button>
        </form>


    </div>


    
<?php 
    include_once 'footer.php'
?>