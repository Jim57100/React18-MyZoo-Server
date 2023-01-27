<?php 
    include_once 'header.php';
    include_once './app/helpers/session_helper.php';
?>

<div class="container mt-5 mb-5 text-center w-50">
    <h1 class="header text-center mt-3 mb-3">Please Signup</h1>

    <?php flash('register') ?>
        <form 
            method="post"
            action="./Users.php" 
            class="form-group">
        <div class="row g-3 align-items-center">
            <div class="col-12 mb-3">
                <input 
                    type="hidden" 
                    name="type" 
                    value="register"
                >
                <input 
                    type="text" 
                    name="usersName" 
                    placeholder="Full name..." 
                    class="form-control"
                >
            </div>
            <div class="col-12 mb-3">
                <input 
                    type="text" 
                    name="usersEmail" 
                    placeholder="Email..." 
                    class="form-control"
                >
            </div>
            <div class="col-12 mb-3">
                <input 
                    type="text" 
                    name="usersUid" 
                    placeholder="Username..." 
                    class="form-control"
                >
            </div>
            <div class="col-12 mb-3">
                <input 
                    type="password" 
                    name="usersPwd" 
                    placeholder="Password..." 
                    class="form-control"
                >
            </div>
            <div class="col-12 mb-3">
                <input 
                    type="password" 
                    name="pwdRepeat" 
                    placeholder="Repeat password" 
                    class="form-control"
                >
            </div>
        </div>
    <button type="submit" name="submit" class="btn btn-primary btn-lg">Sign Up</button>
</form>

</div>


<footer style="height: 12vh">
    <?php 
        include_once 'footer.php'
    ?>
</div>    

