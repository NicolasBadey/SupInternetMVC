<?php

namespace WebSite\Controller;

class homeController extends AbstractBaseController{
public function listUserAction($request) {

        //Use Doctrine DBAL here
       
        // http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/data-retrieval-and-manipulation.html
        // it's much better if you use QueryBuilder : http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/query-builder.html
        
        
        $request= $conn->createQueryBuilder()
                ->select('*')
                ->from('users','u')
                ->execute();


        $user = $request->fetchAll();

        $conn = $this->getConnection();
       

        //you can return a Response object
        return [
            // je pars de l index et je retourne en arriere
            'view' => '../src/WebSite/View/user/listUser.html.php', // should be Twig : 'SupInternetMVC/View/user/listUser.html.twig'
            'users' => $user

        ];
    }
    }