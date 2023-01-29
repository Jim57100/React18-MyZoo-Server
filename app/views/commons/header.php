<?php 
    // session_start(); 
    $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
    $url[1] == 'user' ?  $_SESSION['role'] = 'user' :  $_SESSION['role'] = 'admin';
?>

<?php if($_SESSION['role'] == 'user') : ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MyZoo | Client</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                <a class="nav-link" href="<?= URL ?>/back/user/login">Home</a>
                </li>
                <?php if(!isset($_SESSION['usersId'])) : ?>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>/back/user/signup">Sign Up</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>/back/user/login">Login</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>.back/common/connexion?q=logout">Logout</a>
                    </li>
                <?php endif; ?>
            </div>
        </div>
    </nav>
<?php else: ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MyZoo | Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <?php if(!isset($_SESSION['usersId'])) : ?>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>/back/common/login">Login</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>/back/common/connexion?q=logout">Logout</a>
                    </li>
                <?php endif; ?>
            </div>
        </div>
    </nav>

<?php endif; ?>

