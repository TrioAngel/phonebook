<?php
require_once "../Core/Router.php";
require_once "../Core/init.php";



$router = new Router();


$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('register', ['controller' => 'Posts', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

//$router->dispatch($_SERVER['QUERY_STRING']);
echo '<pre>';
echo htmlspecialchars(print_r($router->getRoutes()), true);
echo '</pre>';


$url = $_SERVER['QUERY_STRING'];

if($router->match($url)){
  echo '<pre>';
  print_r($router->getParams());
  echo '</pre>';
} else{
  echo "no route found for url '$url '";
}

if(Session::exists('home')) {
  echo '<p>' . Session::flash('home') . '</p>';
}

echo Session::get(Config::get('session/session_name'));

