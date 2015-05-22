<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>

    <body>
    	<?php
    if (isset($_SESSION['flashBag'])) {
        foreach ($_SESSION['flashBag'] as $type => $flash) {
            foreach ($flash as $key => $message) {
                echo '<div class="'.$type.'" role="'.$type.'" >'.$message.'</div>';
                // un fois affiché le message doit être supprimé
                unset($_SESSION['flashBag'][$type][$key]);
            }
        }
    }

?>


vous êtes déconnecter

<a href='?p=add_user'>inscrire</a>
<a href='?p=log_user'>login</a>





    
    </body>
</html>
