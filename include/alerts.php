<?php
    if(isset($_SESSION['success'])):?>
        <div class="alert alert-success m-auto px-5 my-5" role="alert">
            <?=$_SESSION['success']?>
        </div>
<?php
        unset($_SESSION['success']);
    endif;
?>

<?php
    if(isset($_SESSION['errors'])):
        foreach($_SESSION['errors'] as $error):
?>
            <div class="alert alert-danger" role="alert">
                <?=$error?>
            </div>
<?php
        endforeach;
        unset($_SESSION['errors']);
    endif
?>