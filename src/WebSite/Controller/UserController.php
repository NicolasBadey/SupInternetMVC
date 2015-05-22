<?php

namespace WebSite\Controller;



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



    /**
     * Recup all users and print it
     *
     * @return array
     */
    public function listUserAction($request) {
         $conn = $this->getConnection();
         
        
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
                if(isset($name)&&isset($password)){

                    
                    $qb = $conn->createQueryBuilder()
                    ->select('count(u.id)')
                    ->from('users','u')
                    ->where ('u.name = :name')
                    ->setParameter('name', $request['request']['name']);

                    $nb_user = (int) $qb->execute()->fetchColumn();
                    
                    if($nb_user <1){


            $conn->insert('users', 
                array('name' => $name,
                    'password'=>$password,
                ));

                $this->addMessageFlash('success', 'inscription réussie !');
                
                        return [
                  'view' => '../src/WebSite/View/user/home.html.php', // => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

            ];
  
                    }else
                            $this->addMessageFlash('error', 'Le pseudo est déjà utilisé !');

                 }


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

         $conn = $this->getConnection();
          if ($request['request']) {

            $qb= $conn->createQueryBuilder()


                            ->delete('*')
                            ->from('users','u')
                            ->where('u.id = ?')
                            ->setParameter(0, $request['request']['name'])
                            ->setParameter(1, $request['request']['password']);


            $qb->execute();

        }
        return [
                'redirect_to' => '?p=add_user',// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

            ];
}

    public function logUser($request) {

        session_start();
    
         $conn = $this->getConnection();

        if ($request['request']) { //if POST
            //handle form with DBAL
            //...
            $name=$request['request']['name'];
            $password=$request['request']['password'];
            if(!empty($name)&&!empty($password)){
                if(isset($name)&&isset($password)){

            $qb= $conn->createQueryBuilder()
                    ->select('count(u.id)')
                    ->from('users','u')
                    ->where ('u.name = :name','u.password = :password')
                    ->setParameter('name', $request['request']['name'])
                    ->setParameter('password', $request['request']['password']);

            $nb_user = (int) $qb->execute()->fetchColumn();
                if($nb_user ==1){

                    $_SESSION['name'] = $name;
                    $_SESSION['password']=$password;
                    
                      return [
                 'redirect_to' => 'index.php',// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

            ];
                }

             }

        }
    }
            $this->addMessageFlash('error','non connecter');
                return [
            'view' => 'WebSite/View/user/logUser.html.php'// => manage it in index.php !! URL should be generate by Routing functions thanks to routing config

        ];
    
}
    public function logOut(){

         $conn = $this->getConnection();

        session_start();
        session_unset();
        session_destroy();

        return ['view' => 'WebSite/View/user/logOut.html.php'];

    

    }
    public function test($request){
        echo'lol';
    }

     public function homeAction($request){
        return ['view' => 'WebSite/View/user/homeAction.html.php'];

    }

}