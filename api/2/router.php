<?php
require __DIR__.'/../../inc/include.php';

$meta = [];
$meta['success'] = true;
$meta['request'] = $request;
$meta['path'] = $route;
$result = null;

//STATE: UNAUTHORISED user
//ACTIONS: user CAN ONLY AUTHORISE

switch ($route[0]) {
  case 'logout':
    logout();
    break;
  case 'debug':
    switch($route[1]) {
      case 'login':
        $_SESSION['user']['id'] = 2;
        $_SESSION['login'] = TRUE;
        $_SESSION['authorised'] = TRUE;
        $meta['status'] = 200;
        break;
      case 'session':
        $meta['status'] = 200;
        $result = $_SESSION;
        break;
    }
    break;
}

if (!isset($_SESSION['authorised']) || $_SESSION['authorised'] == False) {
  if($request==='GET') {
    switch ($route[0]) {
      case 'oauth':
        switch ($route[1]) {
          case 'authorise':
              authorise();
            break;
          case '':
            initate();
            break;
        }
        break;
    }
  }
  $meta['success'] = false;
  $meta['msg'] = 'You are an unauthorised user, please authorise';
  $meta['status'] = 401;
  $meta['authorised'] = $_SESSION['authorised'];
  send($meta);
  exit;
}

//STATE: AUTHORISED BUT NO user profile FOUND
//ACTIONS: user MUST CREATE ACCOUNT
else if (!isset($_SESSION['login']) || $_SESSION['login'] === FALSE) {
  if($request==='POST') {
    switch ($route[1]) {
      case 'user':
        $result = createUser($data);
        $meta['status'] = 201;
        send($meta, $result);
        break;
    }
  }
  $meta['success'] = false;
  $meta['msg'] = 'No user account has been found, please create an account';
  $meta['status'] = 400;
  send($meta);
  exit;
}

//STATE: user IS AUTHORISED & IS LOGGED IN

//UPDATE USER ACCOUNT IN CASE OF CHANGES
//DOES NOT WORK
$_SESSION['user'] = getProfile($_SESSION['user']['id']);

//MAIN ROUTER
switch ($route[0]) {
  case 'repo':
  switch ($request) {
    case 'POST':
      switch($route[1]) {
        case 'id':
          $meta['status'] = 200;
          repoUpload($id);
          $result = json_decode($_POST['payload']);
          break;
        }
      break;
  }
    break;
  case 'search':
    switch ($request) {
      case 'POST':
        switch ($route[1]) {
          case 'profile':
            break;
          case 'university':
            break;
          case 'course':
            break;
          case 'group':
            break;
        }
        break;
    }
    break;
  case 'user':
    switch ($request) {
      case 'GET':
        switch ($route[1]) {
          case 'posts':
            $result = getAuthorPosts($_SESSION['user']['id']);
            $meta['status'] = 200;
            break;
          case '':
            $result = getProfile($_SESSION['user']['id']);
            (is_null($result)) ? $meta['status'] = 401 : $meta['status'] = 200;
            break;
        }
        break;
      case 'POST':
        switch ($route[1]) {
          case 'picture':
            pictureUpload($_SESSION['user']['eid']);
            $meta['status'] = 200;
          break;
        }
        break;
      case 'DELETE':
        //FILLER
        break;
    }
    break;
  case 'profile':
    switch ($request) {
      case 'GET':
        switch ($route[1]) {
          case 'id':
            switch ($route[2]) {
              case '':
                $result = getProfile($id);
                (is_null($result)) ? $meta['status'] = 401 : $meta['status'] = 200;
                break;
              case 'posts':
                $result = getAuthorPosts($id);
                $meta['status'] = 200;
                break;
            }
            break;
          case '':
            $result = getProfiles();
            $meta['status'] = 200;
            break;
          }
        break;
    }
    break;
  case 'university':
    switch ($request) {
      case 'GET':
        switch ($route[1]) {
          case 'id':
            switch ($route[2]) {
              case '':
                $result = getUniversity($id);
                (is_null($result)) ? $meta['status'] = 401 : $meta['status'] = 200;
                break;
              case 'posts':
                $result = getTargetPosts($id, 'university');
                $meta['status'] = 200;
                break;
            }
            break;
          case '':
            $result = getUniversities(); //Not made yet
            $meta['status'] = 200;
            break;
          }
        break;
      case 'POST':
        switch ($route[1]) {
          case '':
            $result = newUniversity($data); //Not made yet
            $meta['status'] = 201;
            break;
          }
        break;
    }
    break;
  case 'course':
    switch ($request) {
      case 'GET':
        switch ($route[1]) {
          case 'id':
            switch ($route[2]) {
              case '':
                $result = getCourse($id);
                (is_null($result)) ? $meta['status'] = 401 : $meta['status'] = 200;
                break;
              case 'posts':
                $result = getTargetPosts($id, 'course');
                $meta['status'] = 200;
                break;
            }
            break;
          case '':
            $result = getCourses(); //Not made yet
            $meta['status'] = 200;
          }
        break;
      case 'POST':
        switch ($route[1]) {
          case '':
            $result = newCourse($data); //Not made yet
            $meta['status'] = 201;
            break;
          }
        break;
    }
    break;
  case 'group':
    switch ($request) {
      case 'GET':
        switch ($route[1]) {
          case 'id':
            switch ($route[2]) {
              case '':
                $result = getGroup($id);
                (is_null($result)) ? $meta['status'] = 401 : $meta['status'] = 200;
                break;
              case 'posts':
                $result = getTargetPosts($id, 'group');
                $meta['status'] = 200;
                break;
            }
          case '':
            $result = getGroups(); //Not made yet
            $meta['status'] = 200;
          }
        break;
      case 'POST':
        switch ($route[1]) {
          case '':
            $result = newGroup($data); //Not made yet
            $meta['status'] = 201;
            break;
          }
        break;
    }
    break;
  case 'posts':
    switch ($request) {
      case 'GET':
        switch ($route[1]) {
          case 'id':
            switch ($route[2]) {
              case 'comments':
                switch ($route[3]) {
                  case 'id':
                    $result = getComment($id); // ID THEN ID ????
                    (is_null($result)) ? $meta['status'] = 401 : $meta['status'] = 200;
                    break;
                  case '':
                    $result = getComments($id);
                    (is_null($result)) ? $meta['status'] = 401 : $meta['status'] = 200;
                    break;
                }
                break;
              case '':
                $result = getPost($id);
                (is_null($result)) ? $meta['status'] = 401 : $meta['status'] = 200;
                break;
              break;
            }
            break;
          }
        break;
      case 'POST':
        switch ($route[1]) {
          case '':
            $result = newPost($data);
            $meta['status'] = 201;
            break;
          case 'id':
            switch($route[2]) {
              case 'comment':
                $result = newComment($id, $data);
                $meta['status'] = 201;
                break;
            }
            break;
          }
        break;
      case 'PUT':
        break;
      case 'DELETE':
        break;
    }
    break;
  case 'entity':
    switch ($request) {
      case 'GET':
        switch($route[1]) {
          case 'id':
            $result = getEntity($id);
            (is_null($result)) ? $meta['status'] = 401 : $meta['status'] = 200;
            break;
        }
        break;
    }
    break;
}

if (!isset($meta['status'])) {
  $meta['success'] = false;
  $meta['status'] = 400;
  $meta['msg'] = 'Invalid url';
}
else if ($meta['status']===401) {
  $meta['success'] = false;
  $meta['msg'] = 'Unauthorised or Invalid ID';
}


send($meta, $result);
?>
