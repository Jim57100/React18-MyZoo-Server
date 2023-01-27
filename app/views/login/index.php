<?php 
    include_once 'header.php'
?>
<div class="container text-center p-5" style="height: 80vh;">
    <h1 id="index-text">Welcome, 
        <?php 
            if(isset($_SESSION['usersId'])){
                echo explode(" ", $_SESSION['usersName'])[0];
            }else{
                echo 'Guest';
            } 
        ?> 
    </h1>
</div>
    
<footer style="height: 12vh">
    <?php 
        include_once 'footer.php'
    ?>
</footer>