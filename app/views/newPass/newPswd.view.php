<?php 
    ob_start();
    include_once './app/helpers/session_helper.php';
?>
<?php 
     $url= $_SERVER['REQUEST_URI'];  
     $url_components = parse_url($url);
     parse_str($url_components['query'], $params);
    
     if(!isset($params['selector']) || !isset($params['validator'])){
        echo 'Could not validate your request!';
    }else{
        $selector = $params['selector'];
        $validator = $params['validator'];
        
        if(ctype_xdigit($selector) && ctype_xdigit($validator)) { ?>
    <h1 class="header">Enter New Password</h1>

    <?php flash('newReset') ?>

    <form method="post" action="<?= URL ?>/back/common/resetCtrl">
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
    