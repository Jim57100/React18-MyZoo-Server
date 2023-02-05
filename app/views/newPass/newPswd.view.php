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

<div class="container d-flex justify-content-center align-items-center flex-column" style="height: 80vh; min-width: 100%">
    <div class="row" style="height: 75px;">
        <div class="col-12">
            <?php flash('newReset') ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="header">Enter New Password</h1>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
                <form class="form-group" method="post" 
                action="<?= URL ?>/back/common/resetCtrl"
                >
                    <input 
                        type="hidden" 
                        name="type" 
                        value="reset" 
                    />
                    <input 
                        type="hidden" 
                        name="selector" 
                        value="<?php echo $selector ?>" />
                    <input 
                        type="hidden" 
                        name="validator" 
                        value="<?php echo $validator ?>" />
                    <input 
                        type="password" 
                        name="pwd" 
                        placeholder="Enter a new password..."
                        class="form-control mb-3">
                    <input 
                        type="password" 
                        name="pwd-repeat"                
                        placeholder="Repeat new password..."
                        class="form-control mb-3">
                    <button type="submit" name="submit" class="btn btn-info mb-3">
                        Send New Password
                    </button>
            </form>
        </div>
    </div>
</div>

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
    