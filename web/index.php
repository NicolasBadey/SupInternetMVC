<?php
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Dumper;
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


$yaml = new Parser();

$routes = $yaml->parse(file_get_contents('/../app/config/routing.yml');
$yaml = Yaml::parse(file_get_contents('/../app/config/routing.yml'));

//ControllerClassName, end name is ...Controller
$controller_class = ... ;

//ActionName, end name is ...Action
$action_name = ...;

$controller = new $controller_class();

//$Request can by an object
$request['request'] = &$_POST;
$request['query'] = &$_GET;
//...

//$response can be an object
$response = $controller->$action_name($request);


/**
 * Use Twig !
 */
require $response['view'];
