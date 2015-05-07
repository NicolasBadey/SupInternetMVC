<?php

/**
 * This is you FrontController, the only point of access to your webapp
 */
 
 require __DIR__ . '/../vendor/autoload.php';
 

/**
 * Use Yaml components for load a config routing, $routes is in yaml app/config/routing.yml :
 *
 * Url will be /index.php?p=route_name
 *
 *
 */
$routes = ...

//Thaks to p=, find the current route
$current_route = ...

//ControllerClassName, end name is ...Controller
$controller_class = ... ;

//ActionName, end name is ...Action
$action_name = ...;

$controller = new $controller_class();

//$Request can by an object
$request['request'] = &$_POST;
$request['query'] = &$_GET;
$request['session'] = &$_SESSION;
//...

//$response can be an object
$response = $controller->$action_name($request);


/**
 * Use Twig !
 */
require $response['view'];
