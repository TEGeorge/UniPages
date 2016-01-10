<?php

/*
Re-usable database utilities in PDO
(c) C Lester 2013 (mysqli), 2014 (PDO)
*/

class DB
{
  $server = "localhost";
  $user = "root";
  $pw = "root";

  try {
    $conn = new PDO("mysql:host=$server;dbname=myDB", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected succesfully";
  }
  catch (PDOException $e) {
    fail( "Connection failed: " . $e->getMessage());
  }
}

?>
