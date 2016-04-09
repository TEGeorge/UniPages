<?php
/*
    Script recieves income API requests, breaks downt the request & rebuilds then sends response
*/

session_start();
$request = $_SERVER['REQUEST_METHOD'];
$data = null;//MIGHT NOT NEED TO GO IN IF POST?
if ($request==='POST') {
  $data = (array)json_decode(file_get_contents('php://input'))->payload;
}

//BUILD ROUTE
$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)).'/';
$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
if (strstr($uri, '?')) {
    $uri = substr($uri, 0, strpos($uri, '?'));
}
$uri = '/'.trim($uri, '/');
$tmproutes = array();
$route = array();
$tmproutes = explode('/', $uri);
foreach ($tmproutes as $uri) {
    if (trim($uri) != '') {
        array_push($route, $uri);
    }
}
if (!isset($route[0])) { array_push($route, ''); }
if (!isset($route[1])) { array_push($route, ''); }
if (!isset($route[2])) { array_push($route, ''); }
if (!isset($route[3])) { array_push($route, ''); }

if (is_numeric($route[1])) {
  $id = (int)$route[1];
  $route[1] = 'id';
}
if (is_numeric($route[2])) {
  $id = (int)($route[2]);
  $route[2] = 'id';
}
if (is_numeric($route[3])) {
  $id = (int)$route[3];
  $route[3] = 'id';
}

include __DIR__.'/router.php';

function send($meta, $payload=null ) {

  $format = 'json';

  if (isset($meta['success']) && $meta['success'] == false) {
    if (!isset($meta['status'])) { $meta['status'] = 500; }
    if (!isset($meta['msg'])) { $meta['msg'] = "Don't Panic"; }
  } else {
    if (!isset($meta['msg'])) { $meta['msg'] = "Success"; }
  }

  $result['payload'] = $payload;
  $result['meta'] = $meta;

  header("HTTP/1.1 {$meta['status']} {$meta['msg']}");

  switch($format) {
    case 'text':
    break;
    case 'json':
      echo json_encode($result);
    break;
    case 'xml':
    break;
  }
}
?>
