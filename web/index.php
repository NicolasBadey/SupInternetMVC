<?php
use Symfony\Component\Yaml\Parser;

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


if(empty($_GET['p'])){
	$page = 'home';
}else{
	$page = $_GET['p'];
}
echo $page;
$yaml = new Parser();

$routes = $yaml->parse(file_get_contents('../app/config/routing.yml'));
$current_route = $routes[$page]['controller'];

$current_route_array = explode(':',$current_route);
//ControllerClassName, end name is ...Controller
$controller_class = $current_route_array[0];

//ActionName, end name is ...Action
$action_name = $current_route_array[1];
echo $controller_class;
$controller = new $controller_class();

//$Request can by an object
$request['request'] = &$_POST;
$request['query'] = &$_GET;
$request['session']=&$_SESSION;
//...

//$response can be an object
$response = $controller->$action_name($request);


if (isset($response['redirect_to'])) {
	header('Location: '.$response['redirect_to']);
	exit;
}

/**
 * Use Twig !
 */
/*require __DIR__ .'../../src/'.$response['view'];*/
require $response['view'];
