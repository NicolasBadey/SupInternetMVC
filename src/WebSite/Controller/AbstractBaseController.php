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


}