<?php

include __DIR__.'/../../inc/ALL.php';

$DB = new DB();

/*
  create Database object

  + $CONNECTION

  + $ROUTES
  + $PREPAREDSTATEMENTS
*/

  if ($routes[0] == 'oauth') {
      include __DIR__.'/../../inc/login.php';
  }

  elseif ($request == 'GET') {
      if ($routes[0] == 'logout') {
          session_destroy();
          exit;
      }
    //*** /.. ***//
    else if ($routes[0] == 'profile') {
        //*** /profile/.. ***//
      if (isset($routes[1])) {
          //*** /profile/posts ***//
        if ($routes[1] == 'posts') {
            $posts = $DB->query("SELECT * FROM post WHERE targetType = 'profile' AND authorID = ".$_SESSION['id'].' OR targetID = '.$_SESSION['id'].' ORDER BY updated_time DESC', true);
            sendResults(loadPosts($posts));
        }
        //*** /profile/<id> ***//
        elseif (is_numeric($routes[1])) {
            //*** /profile/<id>/.. ***//
          if (isset($routes[2])) {
              //*** /profile/<id>/posts ***//
            if ($routes[2] == 'posts') {
                $posts = $DB->query("SELECT * FROM post WHERE targetType = 'profile' AND authorID = ".$routes[1].' OR targetID = '.$routes[1].' ORDER BY updated_time DESC', true);
                sendResults(loadPosts($posts));
            }
          }
          //*** /profile/<id> ***//
          else {
              $profile = $DB->query('SELECT * FROM profile WHERE profileID = '.$routes[1], true);
              sendResults($profile);
          }
        }
      }
      //*** /profile ***//
      else {
          $profile = $DB->query('SELECT * FROM profile WHERE profileID = '.$_SESSION['id'], true);
          sendResults($profile);
      }
    }

    //*** /.. ***//
    if ($routes[0] == 'university') {
        //*** /university/.. ***//
      if (isset($routes[1])) {
          //*** /university/posts ***//
        if ($routes[1] == 'posts') {
            $posts = $DB->query("SELECT * FROM post WHERE targetType = 'university' AND targetID = ".$_SESSION['uni'].' ORDER BY updated_time DESC', true);
            sendResults(loadPosts($posts));
        }
        //*** /university/<id> ***//
        elseif (is_numeric($routes[1])) {
            $university = $DB->query('SELECT * FROM university WHERE uniID = '.$routes[1], true);
            sendResults($university);
        }
      }
      //*** /university *** //
      else {
          $university = $DB->query('SELECT * FROM university WHERE uniID = '.$_SESSION['uni'], true);
          sendResults($university);
      }
    }

    //*** /.. ***//
    if ($routes[0] == 'course') {
        //*** /course/.. ***//
      if (isset($routes[1])) {
          //*** /course/posts ***//
        if ($routes[1] == 'posts') {
            $posts = $DB->query("SELECT * FROM post WHERE targetType = 'course' AND targetID = ".$_SESSION['course'].' ORDER BY updated_time DESC', true);
            sendResults(loadPosts($posts));
        }
        //*** /university/<id> ***//
        elseif (is_numeric($routes[1])) {
            $course = $DB->query('SELECT * FROM course WHERE courseID = '.$routes[1], true);
            sendResults($course);
        }
      }
      //*** /university *** //
      else {
          $course = $DB->query('SELECT * FROM course WHERE courseID = '.$_SESSION['course'], true);
          sendResults($course);
      }
    }

    //*** /.. ***//
    if ($routes[0] == 'group') {
        //*** /group/.. ***//
      if (isset($routes[1])) {
          //*** /group/<id> ***//
        if (is_numeric($routes[1])) {
            //*** /group/<id>/posts ***//
          if (isset($routes[2]) && $routes[2] == 'posts') {
              $posts = $DB->query("SELECT * FROM post WHERE targetType = 'group' AND targetID = ".$routes[1].' ORDER BY updated_time DESC', true);
              sendResults(loadPosts($posts));
          }
          //*** /group/<id> ***//
          else {
              $group = $DB->query('SELECT * FROM `group` WHERE groupID = '.$routes[1], true);
              sendResults($group);
          }
        }
        //*** /group/posts ***//
        elseif ($routes[1] == 'posts') {
            //GET ALL USERS GROUP
          //PULL POSTS FOR ALL USERS ID
        }
      }
      //*** /group ***//
      else {
          //GET ALL USERS GROUP list
        //FOR EACH GROUP USER IS IN ADD TO list
        //SEND LIST
      }
    }

    if ($routes[0] == 'search') {
      if(isset($routes[1])) {
        if($routes[1]=='profile'){}        }
        else if ($routes[1]=='groups') {}
        else if ($routes[1]=='course') {}
        else if ($routes[1]=='university') {}
        }
      }
    }
  }
  elseif ($request == 'POST') {
      $data = json_decode(file_get_contents('php://input'));
      if ($routes[0] == 'post') {
          $type = (string) $data->targetType;
          $content = (string) $data->content;
          $sql = "INSERT INTO post (authorID, targetType, targetID, content, updated_time)
        VALUES ({$_SESSION['id']}, '$type', {$data->targetID}, '$content', now());";
          $DB->query($sql, false);
      }
      if ($routes[0] == 'comment') {
          $content = (string) $data->content;
          $sql = "INSERT INTO comment (postID, authorID, content)
        VALUES ({$data->postID}, {$_SESSION['id']}, '$content');";
          $DB->query($sql, false);
          $sql = "UPDATE post
              SET updated_time=now()
              WHERE postID = {$data->postID};";
          $DB->query($sql, false);
      }
      if ($routes[0] == 'profile') {
        if (isset($routes[1])) {
          if ($routes[1]== 'picture') {
            sendResults($_FILES);
            define ('SITE_ROOT', __DIR__.'/../../');
            $file_ext   = explode('.', $_FILES['profile_picture']['name']);
            $file_ext   = strtolower(end($file_ext));
            $result = move_uploaded_file($_FILES['profile_picture']['tmp_name'], SITE_ROOT."/image/".$_SESSION['id'].".".$file_ext);
            if(!$result) {

              exit;
            }
          }
        }
        else {
          $first_name = "'".(string) $data->first_name."'";
          $surname = "'".(string) $data->surname."'";
          $email = "'".(string) $data->email."'";
          $sql = "INSERT INTO profile (first_name, surname, email)
      VALUES ($first_name, $surname, $email);";
          $DB->query($sql, False);
          $id = $DB->lastId();
          //POTENTIAL SECRUITY FLAW, GID COULD NOT HAVE BEEN SET OR USER MAY
          //NOT BE ADDED THEREFORE LAST ID MIGHT BE PREVIOUS USER?
          $sql = "INSERT INTO login (profileID, googleID)
          VALUES ($id, {$_SESSION['gid']});";
          $DB->query($sql, False);
          login($_SESSION['gid']);
          exit;
        }
      }
  }

  function login ($gid) {
    global $DB;
    $user = $DB->query("SELECT * FROM login INNER JOIN profile ON profile.profileID=login.profileID WHERE googleID = ".$gid, True);
    $_SESSION['login'] = True;
    $_SESSION['id'] = $user[0]['profileID'];
    $_SESSION['uni'] = $user[0]['university'];
    $_SESSION['course'] = $user[0]['course'];
    header('Location: http://localhost:8080/home.php');
    exit;
  }

  function loadPosts($results)
  {
      $newResults = array();
      foreach ($results as $post) {
          $post = getPostDetails($post);
          array_push($newResults, $post);
      }

      return $newResults;
  }

  function getPostDetails($post)
  {
      global $DB;
      $author = $DB->query('SELECT first_name, surname FROM profile WHERE profileID = '.$post['authorID'], true);
      $author = $author[0]['first_name'].' '.$author[0]['surname'];
      switch ($post['targetType']) {
      case 'profile':
        $target = $DB->query('SELECT first_name, surname FROM profile WHERE profileID = '.$post['targetID'], true);
        $target = $target[0]['first_name'].' '.$target[0]['surname'];
        break;
      case 'university':
        $target = $DB->query('SELECT uni_name FROM university WHERE uniID = '.$post['targetID'], true);
        $target = $target[0]['uni_name'];
        break;
      case 'group':
        $target = $DB->query('SELECT group_name FROM `group` WHERE groupID = '.$post['targetID'], true);
        $target = $target[0]['group_name'];
        break;
      case 'course':
        $target = $DB->query('SELECT course_name FROM course WHERE courseID = '.$post['targetID'], true);
        $target = $target[0]['course_name'];
    }
      $post['author'] = $author;
      $post['target'] = $target;
      $post['comments'] = getComments($post);

      return $post;
  }

  function getComments($post)
  {
      global $DB;
      $results = $DB->query('SELECT authorID, time_stamp, content FROM comment WHERE postID = '.$post['postID'], true);
      $comments = array();
      foreach ($results as $comment) {
          //LOAD COMMENT DETAILS
      $author = $DB->query('SELECT first_name, surname FROM profile WHERE profileID = '.$comment['authorID'], true);
          $comment['author'] = $author[0]['first_name'].' '.$author[0]['surname'];
          array_push($comments, $comment);
      }

      return $comments;
  }
