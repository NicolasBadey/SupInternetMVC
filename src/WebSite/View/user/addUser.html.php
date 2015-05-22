<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>

    <body>

<form method="post" action="">
  pseudo<input type="text" name="name" /></input>
  password<input type="password" name="password" /></input>
  <input type="submit" value="Envoyer" />
</form>


<!-- <a href='?p=logUser.html.php'>login</a> -->
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
<a href='?p=log_user'>login</a>
    </body>
</html>
