<?php
use Symfony\Component\Yaml\Yaml;

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


/*if(empty($_GET['p'])){
	$page = 'home';
}else{
	$page = $_GET['p'];
}*/


if(isset($_GET['p'])){
    $page = $_GET['p'];
} else {
    $page = 'list_user';
}

$yaml = new Yaml();
$routes = $yaml->parse(file_get_contents('../app/config/routing.yml'));
if (!empty($routes[$page]['controller'])) {

	$current_route = explode(':',$routes[$page]['controller']);
} else {
	throw new Exception('add routing config for '.$page.' in routing.yml');
}
//ControllerClassName, end name is ...Controller
$controller_class = $current_route[0];

//ActionName, end name is ...Action
$action_name = $current_route[1];
echo $controller_class;
$controller = new $controller_class();

//$Request can by an object
$request['request'] = &$_POST;
$request['query'] = &$_GET;
$request['session']=&$_SESSION;
//...

//$response can be an object
$response = $controller->$action_name($request);


if (!empty($response['redirect_to'])) {
	header('Location: '.$response['redirect_to']);
	
}elseif(!empty($response['view'])){
	/**
	 * Use Twig !
	 */
	require __DIR__ .'/../src/'.$response['view'];
	
} else {
	throw new Exception('response object is not complet');


}