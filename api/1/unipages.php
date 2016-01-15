<?php

  include __DIR__.'/../../inc/db.php';

  $DB = new DB;

/*
  create Database object

  + $CONNECTION

  + $ROUTES
  + $PREPAREDSTATEMENTS
*/
  if($routes[0] == 'profile')
  {
    $results = $DB->query("SELECT * FROM `profile`;");
    echo 'API routed success, ';
    sendResults($results);
  }

 ?>
