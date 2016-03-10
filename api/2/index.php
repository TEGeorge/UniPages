<?php
/*
    Script recieves income API requests, breaks downt the request & rebuilds then sends response
*/

    function getCurrentUri()
    {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)).'/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        $uri = '/'.trim($uri, '/');

        return $uri;
    }

    function send($results, $json)
    {
      if ($json=='json') {
          $results = json_encode($results);
      }
        echo $results;
    }

    session_start();
    $request = $_SERVER['REQUEST_METHOD'];
    $base_url = getCurrentUri();
    $tmproutes = array();
    $route = array();
    //MIGHT NOT NEED TO GO IN IF POST?
    $data = null;
    if ($request=='POST') {$data = json_decode(file_get_contents('php://input'));}
    $tmproutes = explode('/', $base_url);
    foreach ($tmproutes as $uri) {
        if (trim($uri) != '') {
            array_push($route, $uri);
        }
    }
    if (!isset($route[0])) { array_push($route, ''); }
    if (!isset($route[1])) { array_push($route, ''); }
    if (!isset($route[2])) { array_push($route, ''); }

    $id = 0
    if (is_numeric($route[1]) {
      $id = $route[1]
      $route[1] = 'id'
    }
    else if (is_numeric($route[2]) {
      $id = $route[2]
      $route[2] = 'id'
    }

    /*
    Now, $routes will contain all the routes. $routes[0] will correspond to first route. For e.g. in above example $routes[0] is search, $routes[1] is book and $routes[2] is fitzgerald
    */
    include __DIR__.'/unipages.php';
