<?php

/*
Re-usable database utilities in PDO
(c) C Lester 2013 (mysqli), 2014 (PDO)
*/

class DB
{

  function __construct () {
  $server = "localhost";
  $user = "root";
  $pw = "root";

  try {
    $conn = new PDO("mysql:host=$server", $user, $pw);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected succesfully, ";

    $conn->exec("CREATE DATABASE IF NOT EXISTS uniPages");
    $conn->exec("use uniPages;");
    echo "Created DB, ";

    $sql = "CREATE TABLE IF NOT EXISTS profile (
      profileID INT NOT NULL AUTO_INCREMENT,
      uniID INT NOT NULL,
      first_name VARCHAR(20),
      surname  VARCHAR(40),
      course INT NOT NULL,
      university INT NOT NULL,
      password VARCHAR(20) NOT NULL,
      PRIMARY KEY(profileID)
    );";
      $sql = trim($sql);
      $conn->exec($sql);
      echo "Profile Table Created, ";


  }
  catch (PDOException $e) {
    echo "DB Error";
    print $e->getMessage();
  }
}
}

?>
