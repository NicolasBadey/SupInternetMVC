<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>

    <body>
<a href='../user/addUser.html.php'>inscrire</a>
<a href='../user/logUser.html.php'>login</a>
<a href='../user/home.html.php'>mmmm</a>

<?php
foreach ($response['users'] as $user) {
	echo $user;
	var_dump($user);
}

?>



    
    </body>
</html>
