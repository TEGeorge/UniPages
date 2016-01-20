<?php
/*
	Script recieves income API requests, breaks downt the request & rebuilds then sends response
*/


	function getCurrentUri()
	{
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
		$uri = '/' . trim($uri, '/');
		return $uri;
	}

	function sendResults($results)
	{
			echo json_encode($results);
	}

	$request = $_SERVER['REQUEST_METHOD'];
	$base_url = getCurrentUri();
	$tmproutes = array();
	$routes = array();
	$tmproutes = explode('/', $base_url);
	foreach($tmproutes as $route)
	{
		if(trim($route) != "")
			array_push($routes, $route);
	}

	/*
	Now, $routes will contain all the routes. $routes[0] will correspond to first route. For e.g. in above example $routes[0] is search, $routes[1] is book and $routes[2] is fitzgerald
	*/
	include __DIR__.'/unipages.php';
