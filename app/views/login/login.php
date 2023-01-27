
<?php
    include_once 'header.php';
    include_once './app/helpers/session_helper.php';
?>
    <div class="container text-center mt-5 mb-5 w-25" style="height: 67vh">
        <h1 class="header text-center mt-5 mb-3">Please Login</h1>
        <form method="post" action="./controllers/Users.php" class="form-group mt-5 mb-5">
            <div class="row g-3">
                <div class="col-12 mb-3">
                    <input type="hidden" name="type" value="login">
                    <input type="text" name="name/email"  
                    placeholder="Username/Email..." class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <input type="password" name="usersPwd" 
                    placeholder="Password..." class="form-control">
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mb-3 btn-lg">Log In</button>
        </form>

        <div class="form-sub-msg">
            <a href="./reset-password.php">Forgotten Password?</a>
        </div>
    </div>


    <?php flash('login') ?>

<footer style="height: 12vh">    
    <?php 
        include_once 'footer.php'
    ?>
</footer>