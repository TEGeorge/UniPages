<?php

require __DIR__.'/../../inc/include.php';

$meta = [];
$meta['success'] = true;
$meta['request'] = $request;
$meta['path'] = $route;

//LOGIN FIRST

//UPDATE USER PROFILE

switch ($route[0]) {
  case 'login': //Changed from oAuth
    switch ($request) {
      case 'GET':
        switch($route[1]) {
          case '':
          break;
          case 'logout':
          break;
          case 'test': //INCLUDED FOR TEST PURPOSES
          break;
        }
      break;
      case 'POST':
        switch($route[1]) {
          case 'response':
          break;
        }
      }
      break;
  break;
  case 'profile':
    switch ($request) {
      case 'GET':
        switch ($route[1]) {
          case 'posts':
            //Get All Posts
          break;
          case 'id':
            $result = getProfile($id);
            $meta['status'] = 200;
          break;
          case '':
            $result = getProfile("1");
            $meta['status'] = 200;
          break;
        }
      break;
      case 'POST':
      break;
    }
  break;
  case 'university':
    switch ($request) {
      case 'GET':
        switch($route[1]) {
          case 'id':
          break;
          case 'posts':
          break;
          case '':
          break;
        }
      break;
      case 'POST':
      break;
    }
  break;
  case 'group':
    switch ($request) {
      case 'GET':
        switch($route[1]) {
        case 'id':
          switch ($route[2]) {
            case 'posts':
            break;
            case '':
            break;
          }
        break;
        case 'posts':
        break;
        case '':
        break;
        }
      break;
      case 'POST':
      break;
    }
  break;
  case 'course':
    switch ($request) {
      case 'GET':
        switch($route[1]) {
        case 'id':
        break;
        case 'posts':
        break;
        case '':
        break;
        }
      break;
      case 'POST':
      break;
    }
  break;
  case 'post':
    switch ($request) {
      case 'POST':
      break;
    }
  break;
  case 'comment':
    switch ($request) {
      case 'POST':

        }
      break;
  break;
  case 'search':
    if ($request=='GET') {
      switch($route[1]) {
        case 'profile':
        break;
        case 'groups':
        break;
        case 'course':
        break;
        case 'university':
        break;
      }
    }
  break;
}

if (!isset($meta['status'])) {
  $meta['success'] = false;
  $meta['status'] = 400;
}

send($meta, $result);
?>
