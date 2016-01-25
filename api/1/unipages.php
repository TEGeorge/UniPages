<?php

  include __DIR__.'/../../inc/db.php';

  $DB = new DB;

/*
  create Database object

  + $CONNECTION

  + $ROUTES
  + $PREPAREDSTATEMENTS
*/
  if($routes[0] == 'profile') {
    if (isset($routes[1])) {
      if (is_numeric($routes[1])) {
        $profile = $DB->query("SELECT * FROM profile WHERE profileID = ".$routes[1]);
        sendResults($profile);
      }
      if($routes[1] == 'posts') {
        $posts = $DB->query("SELECT * FROM post WHERE author = ".$_SESSION['id']." OR target = ".$_SESSION['id']);
        sendResults($posts);
      }
    }
    else {
      $profile = $DB->query("SELECT * FROM profile WHERE profileID = ".$_SESSION['id']);
      sendResults($profile);
    }
    //echo 'API routed success, ';

  }

  if($routes[0] =='university') {
    if (isset($routes[1]) && (is_numeric($routes[1])))
    {
      $university = $DB->query("SELECT * FROM university WHERE uniID = ".$routes[1]);
    }
    else
    {
      $university = $DB->query("SELECT * FROM university WHERE uniID = ".$_SESSION['uni']);
    }
    sendResults($university);
  }

  if($routes[0] =='group') {
    if (isset($routes[1]) && (is_numeric($routes[1])))
    {
      $group = $DB->query("SELECT * FROM `group` WHERE groupID = ".$routes[1]);
      sendResults($group);
    }
  }



?>
