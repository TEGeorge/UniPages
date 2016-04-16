<?php
session_start();
/*
    Script recieves income API requests, breaks downt the request & rebuilds then sends response
*/


$request = $_SERVER['REQUEST_METHOD'];

//Get data from POST
$data = null;
if ($request==='POST') {
    $data = (array)json_decode(file_get_contents('php://input'))->payload;
  }

//Takes URL and breaks it into array
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

//If any route is numeric set the last as ID variable & define that route as 'id'
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

/**
 * Function: Build and send response
 * $meta: Used for sending debug infomation & headers
 * $payload: Any data to be sent
 */
function send($meta, $payload=null ) {
  if(!isset($meta['format'])) {$meta['format']='json';}

  $format = $meta['format'];

  if (isset($meta['success']) && $meta['success'] == false) {
    if (!isset($meta['status'])) { $meta['status'] = 500; }
    if (!isset($meta['msg'])) { $meta['msg'] = "Don't Panic, unidentified error, no msg set"; }
  } else {
    if (!isset($meta['msg'])) { $meta['msg'] = "Success"; }
  }

  $result['payload'] = $payload;
  $result['meta'] = $meta;

  header("HTTP/1.1 {$meta['status']} {$meta['msg']}");

  switch($format) {
    case 'json':
      header('Content-Type: application/json');
      echo json_encode($result);
    break;
    case 'file':
      header('Content-Type: application/octet-stream');
      readFile($payload);
    break;
    case 'url':
      header('Content-type: application/x-www-form-urlencoded');
      echo $payload;
  }

  exit();
}

function redirect($url, $msg) {
  $meta['status'] = 302;
  $meta['success'] = true;
  $meta['redirect'] = $url;
  $meta['msg'] = $msg;
  send($meta);
}
?>
