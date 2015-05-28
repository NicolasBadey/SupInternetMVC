<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>

    <body>
<a href='?p=logout_user'>deconnecter</a><br>
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
       session_start();



$bdd = new PDO('mysql:dbname=tweeter;host=localhost','root','');
	$res=$bdd->query('SELECT * FROM users');
	while($donnees=$res->fetch()){
		echo'Les users inscrit sont : ';
		echo $donnees['name'];
		echo'<a href="?p=delete_user&id='.$donnees['id'].'"><img src="delete.png"   height="40" width="40"></a><br>';
	}



/*
foreach ($response['users'] as $user) {
	echo $user;
	var_dump($user);
}*/

?>



    
    </body>
</html>
