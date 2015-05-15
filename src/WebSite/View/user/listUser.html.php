<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>

    <body>
<a href='?p=add_user'>inscrire</a>
<a href='?p=log_user'>login</a>
<a href='../user/home.html.php'>mmmm</a>

<?php

foreach ($response['users'] as $user) {
	echo $user;
	var_dump($user);
}

?>



    
    </body>
</html>
