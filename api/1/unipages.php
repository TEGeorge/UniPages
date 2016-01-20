<?php

  include __DIR__.'/../../inc/db.php';

  $DB = new DB;

/*
  create Database object

  + $CONNECTION

  + $ROUTES
  + $PREPAREDSTATEMENTS
*/
  $_SESSION['id'] = 1;
  if($routes[0] == 'profile')
  {
    $profile = $DB->query("SELECT * FROM profile WHERE profileID = ".$_SESSION['id']);
    //echo 'API routed success, ';
    sendResults($profile);
  }

  if($routes[0] =='university') {
    $result = $DB->query("SELECT university FROM profile WHERE profileID = ".$_SESSION['id']);
    $university = $DB->query("SELECT * FROM university WHERE uniID = ".$result[0]['university']);
    sendResults($university);
  }
?>
