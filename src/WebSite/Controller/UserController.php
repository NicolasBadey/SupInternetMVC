<?php

namespace WebSite\Controller;
/*include_once 'AbstractBaseController.php';*/
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 23/04/2015
 * Time: 23:45
 */



/**
 * Class UserController
 *
 * Controller of all User actions
 *
 * @package SupInternetMVC\Controller
 */
class UserController extends AbstractBaseController{


    private $id;
    private $name;
    private $password;

/*public function addUser($request) {

        //Use Doctrine DBAL here
        $config = new \Doctrine\DBAL\Configuration();
        $connectionParams = array(
            'dbname' => 'tweeter',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );

        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);


        if ($request['request']) { //if POST
            //handle form with DBAL
            //...
             $request= $conn->createQueryBuilder()
                ->insert('users')
                ->setValue('name',$name)
                ->setValue('password',$password)
                
                ->setParameter(0, $name)
                ->setParameter(1, $password);

             
/*                ->setParameter(0, $name)
                ->setParameter(1, $password);*/

/*

                ->setParameters ['name' =>:name]
                ->setParameters ['password' =>:password]*/


            //Redirect to show
            //you should return a RedirectResponse object
/*                       return [
                'redirect_to' => 'http://.......',// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

            ];

        }


       }
     */

    /**
     * Recup all users and print it
     *
     * @return array
     */
    public function listUserAction($request) {

        //Use Doctrine DBAL here
/*        $config = new \Doctrine\DBAL\Configuration();
        //for this array use config_dev.yml and YamlComponents
        // http://symfony.com/fr/doc/current/components/yaml/introduction.html
        $connectionParams = array(
            'dbname' => 'tweeter',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
        
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);*/
         $conn = $this->getConnection();
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
            'view' => 'WebSite/View/user/listUser.html.php', // should be Twig : 'SupInternetMVC/View/user/listUser.html.twig'
            'users' => $user

        ];
    }


    /**
     * swho one user thanks to his id : &id=...
     *
     * @return array
     */
    public function showUserAction($request) {
        //Use Doctrine DBAL here
        //.....................................................................................................................
/*        $config = new \Doctrine\DBAL\Configuration();

        $connectionParams = array(
            'dbname' => 'tweeter',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );

        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);*/
         $conn = $this->getConnection();

      
        $request= $conn->createQueryBuilder()
                ->select('*')
                ->from('users')
                ->where('id= ?')
                ->setParameter(0, $username);

        $user=$request->fetch();
        if(!$request){
            throw $this->createNotFoundException(
                'Aucun produit trouvé pour cet id');
            
        }

        //you can return a Response object
        return [
            'view' => '../View/user/showUser.html.php', // should be Twig : 'SupInternetMVC/View/user/listUser.html.twig'
            'user' => $user
        ];
    }

    /**
     * Add User and redirect on listUser after
     */
    public function addUser($request) {
         $conn = $this->getConnection();


        if ($request['request']) { //if POST
            $name=$request['request']['name'];
            $password=$request['request']['password'];
            if(!empty($name)&&!empty($password)){


            $conn->insert('users', 
                array('name' => $name,
                    'password'=>$password,
                ));
                        return [
                 'redirect_to' => 'index.php',// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

            ];
            }
        }
        //you should return a Response object
        return [
            'view' => 'WebSite/View/user/addUser.html.php',// => create the file

        ];
    }


    /**
     * Delete User and redirect on listUser after
     */
    public function deleteUser($request) {


        //Use Doctrine DBAL here
/*        $config = new \Doctrine\DBAL\Configuration();
        $connectionParams = array(
            'dbname' => 'tweeter',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );

        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);*/
         $conn = $this->getConnection();
          if ($request['request']) {

            $qb= $conn->createQueryBuilder()


                            ->delete('*')
                            ->from('users','u')
                            ->where('u.id = ?')
                            ->setParameter(0, $request['request']['name'])
                            ->setParameter(1, $request['request']['password']);


            $qb->execute();
            //you should return a RedirectResponse object , redirect to list

        }
        return [
                'redirect_to' => 'http://localhost/bash/web',// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

            ];
}

    /**
     * Log User (Session) , add session in $request first (index.php)
     */
    public function logUser($request) {
        session_start();
        if ($request['request']) { //if POST
            //handle form with DBAL
            //...
 $conn = $this->getConnection();
            $qb= $conn->createQueryBuilder()
                            ->select('*')
                            ->from('users')
                            ->where('name=?','password=?')
                            ->setParameter(0, $name)
                            ->setParameter(1, $password);

/////////////////
            $user=$qb->execute();
            if('name=?'&&'password=?'){
                echo 'you are connected';
                $request['session'] = $user;
              
            }
            elseif('name!=?'){
                echo 'user not exist';
            }
            elseif('password?=?')
            {
                echo'password not matched';
            }


        }


        //take FlashBag system from
        // https://github.com/NicolasBadey/SupInternetTweeter/blob/master/model/functions.php
        // line 87 : https://github.com/NicolasBadey/SupInternetTweeter/blob/master/index.php
        // and manage error and success

        //Redirect to list or home
        //you should return a RedirectResponse object
        return [
            'redirect_to' => 'http://index.php?p=log_user'// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

        ];

    }
    public function logOut(){

         $conn = $this->getConnection();

        session_start();
        session_unset();
        session_destroy();

        return [
            'redirect_to' => 'http://index.php?p=log_user',// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

        ];

    }
    public function test($request){
        echo'lol';
    }

     public function homeAction($request){
        return ['view' => 'WebSite/View/user/homeAction.html.php'];

    }

}