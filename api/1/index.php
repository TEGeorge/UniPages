<?php
/*
	The following function will strip the script name from URL i.e.  http://www.something.com/search/book/fitzgerald will become /search/book/fitzgerald
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
	    global $_REQUEST;

	    $jsonFormatParameter = isset($_REQUEST['format']) && ($_REQUEST['format'] == 'json');
	    $jsonHeaderRequest = !(stripos($_SERVER['HTTP_ACCEPT'], 'application/json') === false);
	    $json = $jsonHeaderRequest || $jsonFormatParameter;

	    if (isset($results["meta"]["ok"]) && $results["meta"]["ok"] === false) {
	        $status = isset($results["meta"]["status"]) ? $results["meta"]["status"] : 599;
	        $msg = isset($results["meta"]["msg"]) ? $results["meta"]["msg"] : "Oh 'eck!";
	    } else {
	        $status = isset($results["meta"]["status"]) ? $results["meta"]["status"] : 200;
	        $msg = isset($results["meta"]["msg"]) ? $results["meta"]["msg"] : "OK";
	    }
	    header("HTTP/1.1 $status $msg");

	    if ($json) {
	        header("Content-Type: application/json");
	        echo json_encode($results);
	    } else {
	        header("Content-Type: text/plain");
	        echo("results: ");
	        var_dump($results);
	    }
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

	include __DIR__.'/../../inc/error.php';
	/*
	Now, $routes will contain all the routes. $routes[0] will correspond to first route. For e.g. in above example $routes[0] is search, $routes[1] is book and $routes[2] is fitzgerald
	*/

	if($routes[0] == 'hello')
	{
		if($routes[1] == 'jim')
		{
			sendResults('hello fred');
		}

		sendResults('hello sam');
	}

	sendResults($routes);
	sendResults($request);
