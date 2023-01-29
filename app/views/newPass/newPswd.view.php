<?php 
    if(empty($_GET['selector']) || empty($_GET['validator'])){
        echo 'Could not validate your request!';
    }else{
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];
        
        if(ctype_xdigit($selector) && ctype_xdigit($validator)) { ?>
<?php 
    ob_start();
    include_once './app/helpers/session_helper.php';
?>
    <h1 class="header">Enter New Password</h1>

    <?php flash('newReset') ?>

    <form method="post" action="./controllers/ResetPasswords.php">
        <input type="hidden" name="type" value="reset" />
        <input type="hidden" name="selector" value="<?php echo $selector ?>" />
        <input type="hidden" name="validator" value="<?php echo $validator ?>" />
        <input type="password" name="pwd" 
        placeholder="Enter a new password...">
        <input type="password" name="pwd-repeat" 
        placeholder="Repeat new password...">
        <button type="submit" name="submit">Receive Email</button>
    </form>

<?php 
    $content = ob_get_clean();
    require './app/views/commons/template.php';    
?>

            
<?php 
    }else{
        echo 'Could not validate your request!';
    }
}
?>
    