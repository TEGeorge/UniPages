<?php
require __DIR__.'/../../inc/include.php';

/**
 * Build meta default
 */
$meta = [];
$meta['success'] = true;
$meta['request'] = $request;
$meta['path'] = $route;
$result = null;


/**
 * Debug router
 */
switch ($route[0]) {
  case 'logout':
    logout();
    break;
  case 'debug':
    switch($route[1]) {
      case 'login':
        $_SESSION['user']['id'] = $id;
        $_SESSION['login'] = TRUE;
        $_SESSION['authorised'] = TRUE;
        $meta['status'] = 200;
        $meta['redirect'] = 'http://'.$_SERVER['HTTP_HOST'].'/home.php';
        break;
      case 'user':
        if ($request==='GET') {
          $result = getDebugProfiles();
          $meta['status'] = 201;
          send($meta, $result);
        }
        else {
          $_SESSION['sub'] = 0;
          $result = newProfile($data);
          $meta['status'] = 201;
          $meta['redirect'] = 'http://'.$_SERVER['HTTP_HOST'].'/home.php';
          send($meta, $result);
        }
      case 'session':
        $meta['status'] = 200;
        $result = $_SESSION;
        break;
    }
    break;
}

/**
 * Router for unauthorised users
 */
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

/**
 * Router for authorised users but no profile
 */
else if (!isset($_SESSION['login']) || $_SESSION['login'] === FALSE) {
  switch($request) {
    case 'GET':
      switch ($route[0]) {
        case 'university':
          switch ($route[1]) {
            case 'id':
              switch ($route[2]) {
                case 'courses':
                  $result = getCourses($id);
                  (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
                  send($meta, $result);
                  break;
              }
              break;
            case '':
              $result = getUniversities();
              (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
              send($meta, $result);
              break;
          }
          break;
      }
      break;
    case 'POST':
      switch ($route[0]) {
        case 'user':
          $result = newProfile($data);
          $meta['status'] = 201;
          $meta['redirect'] = 'http://'.$_SERVER['HTTP_HOST'].'/home.php';
          send($meta, $result);
          break;
      }
      break;
}
  $meta['success'] = false;
  $meta['msg'] = 'No user account has been found, please create an account';
  $meta['status'] = 400;
  send($meta);
  exit;
}

$_SESSION['user'] = getUser($_SESSION['user']['id']); //Update user information

/**
 * Main router
 */
switch ($route[0]) {
  case 'picture':
    switch ($request) {
      case 'POST':
        switch ($route[1]) {
          case 'id':
            pictureUpload($id);
            $meta['status'] = 200;
            break;
        }
        break;
    }
    break;
  case 'search':
    switch ($request) {
      case 'GET':
        switch ($route[1]) {
          case 'group':
            $result = searchGroup($route[2]);
            (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
            break;
          case 'profile':
            $result = searchProfile($route[2]);
            (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
            break;
        }
        break;
    }
    break;
  case 'join':
    switch ($request) {
      case 'POST':
        switch ($route[1]) {
          case 'id':
            joinGroup($id);
            (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 201;
            break;
        }
        break;
      case 'DELETE':
      switch ($route[1]) {
        case 'id':
          leaveGroup($id);
          (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
          break;
      }
        break;
    }
    break;
  case 'repo':
    switch ($request) {
      case 'POST':
        switch($route[1]) {
          case 'id':
            switch ($route[2]) {
              case '':
                $result = repoUpload($id);
                $meta['status'] = 200;
                break;
            }
            break;
          }
        break;
      case 'GET':
      case 'id':
        switch ($route[2]) {
          case '':
            $result = getRepo($id);
            $meta['status'] = 200;
            break;
          case 'id':
            $result = getFile($id);
            $meta['status'] = 203;
            $meta['format'] = 'file';
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
            (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
            break;
          case '':
            $result = getUser($_SESSION['user']['id']);
            (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
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
                (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
                break;
              case 'posts':
                $result = getAuthorPosts($id);
                (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
                break;
            }
            break;
          case '':
            $result = getProfiles();
            (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
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
                (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
                break;
              case 'posts':
                $result = getTargetPosts($id, 'university');
                (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
                break;
              case 'courses':
                $result = getCourses($id);
                (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
            }
            break;
          case '':
            $result = getUniversities(); //Not made yet
            (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
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
                (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
                break;
              case 'posts':
                $result = getTargetPosts($id, 'course');
                (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
                break;
            }
            break;
          case '':
            $result = getCourses();
            (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
          }
        break;
      case 'POST':
        switch ($route[1]) {
          case '':
            $result = newCourse($data);
            $meta['status'] = 201;
            $meta['redirect'] = 'http://'.$_SERVER['HTTP_HOST'].'/home.php';
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
                (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
                break;
              case 'posts':
                $result = getTargetPosts($id, 'group');
                $meta['status'] = 200;
                break;
            }
            break;
          case '':
            $result = getGroups(); //Not made yet
            $meta['status'] = 200;
            break;
          }
        break;
      case 'POST':
        switch ($route[1]) {
          case '':
            $result = newGroup($data); //Not made yet
            $meta['status'] = 201;
            $meta['redirect'] = 'http://'.$_SERVER['HTTP_HOST'].'/home.php';
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
                    (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
                    break;
                  case '':
                    $result = getComments($id);
                    (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
                    break;
                }
                break;
              case '':
                $result = getPost($id);
                (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
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
            (is_null($result)) ? $meta['status'] = 401 : $meta['status'] = 201;
            break;
          case 'id':
            switch($route[2]) {
              case 'comment':
                $result = newComment($id, $data);
                (is_null($result)) ? $meta['status'] = 401 : $meta['status'] = 201;
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
            (is_null($result)) ? $meta['status'] = 204 : $meta['status'] = 200;
            break;
        }
        break;
    }
    break;
}

/**
 * Build status based inaction
 */
if (!isset($meta['status'])) {
  $meta['success'] = false;
  $meta['status'] = 400;
  $meta['msg'] = 'Invalid url';
}
else if ($meta['status']===401) {
  $meta['success'] = false;
  $meta['msg'] = 'Unauthorised';
}
else if ($meta['status']===401) {
  $meta['success'] = false;
  $meta['msg'] = 'No content';
}


send($meta, $result);
?>
