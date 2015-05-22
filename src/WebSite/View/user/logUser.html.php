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


<form method="post" action="">
  <input type="text" name="name" />pseudo</input>
  <input type="password" name="password" />password</input>
  <input type="submit" value="Envoyer" />
</form>

<a href='?p=add_user'>inscrire</a>






    
    </body>
</html>
