<?php

function login ($gid) {
    $DB = new DB();
    $user = $DB->query("SELECT * FROM login INNER JOIN profile ON profile.profileID=login.profileID WHERE googleID = ".$gid, True);
    $_SESSION['login'] = True;
    $_SESSION['id'] = $user[0]['profileID'];
    $_SESSION['uni'] = $user[0]['university'];
    $_SESSION['course'] = $user[0]['course'];
    header('Location: http://localhost:8080/home.php');
    $DB ->close();
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
      $DB = new DB();
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
      $DB->close();
      return $post;
  }

  function getComments($post)
  {
      $DB = new DB();
      $results = $DB->query('SELECT authorID, time_stamp, content FROM comment WHERE postID = '.$post['postID'], true);
      $comments = array();
      foreach ($results as $comment) {
          //LOAD COMMENT DETAILS
      $author = $DB->query('SELECT first_name, surname FROM profile WHERE profileID = '.$comment['authorID'], true);
          $comment['author'] = $author[0]['first_name'].' '.$author[0]['surname'];
          array_push($comments, $comment);
      }
      $DB->close();
      return $comments;
  }

  function getProfile($id) {
    $DB = new DB();
    $bindings = array($id);
    $result = $DB->query('SELECT * FROM profile
       LEFT JOIN university ON profile.university=university.uniID
       LEFT JOIN course ON profile.course=course.courseID
       WHERE profileID = ?', $bindings);
    $DB->close();
    return $result;
  }
 ?>
