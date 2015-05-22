<?php
namespace WebSite\Controller;

use Symfony\Component\Yaml\Yaml;

class AbstractBaseController{




	public function getConnection(){

	 //Use Doctrine DBAL here


	$yaml = new Yaml();

	$config = $yaml->parse(file_get_contents('../app/config/config-prod.yml'));

        
       return  \Doctrine\DBAL\DriverManager::getConnection($config['doctrine'], new \Doctrine\DBAL\Configuration());


	}

		public function addMessageFlash($type, $message) {
	    // autorise que 4 types de messages flash
	    $types = ['success','error','alert','info'];
	    if (!in_array($type, $types)) {
	        throw new \Exception("Type not exists for message flash");
	        ;
	    }

	    // on vérifie que le type existe
	    if (!isset($_SESSION['flashBag'][$type])) {
	        //si non on le créé avec un Array vide
	        $_SESSION['flashBag'][$type] = [];
	    }

	    // on ajoute le message
	    $_SESSION['flashBag'][$type][] = $message;
	}


}