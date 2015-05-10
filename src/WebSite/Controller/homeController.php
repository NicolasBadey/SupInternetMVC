<?php

namespace WebSite\Controller;
class homeController{
public function listUserAction($request) {

        //Use Doctrine DBAL here
        $config = new \Doctrine\DBAL\Configuration();
        //for this array use config_dev.yml and YamlComponents
        // http://symfony.com/fr/doc/current/components/yaml/introduction.html
        $connectionParams = array(
            'dbname' => 'tweeter',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
        
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
        // http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/data-retrieval-and-manipulation.html
        // it's much better if you use QueryBuilder : http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/query-builder.html
        
        
        $request= $conn->createQueryBuilder()
                ->select('*')
                ->from('users','u')
                ->execute();


        $user = $request->fetchAll();
       

        //you can return a Response object
        return [
            // je pars de l index et je retourne en arriere
            'view' => '../src/WebSite/View/user/listUser.html.php', // should be Twig : 'SupInternetMVC/View/user/listUser.html.twig'
            'users' => $user

        ];
    }
    }