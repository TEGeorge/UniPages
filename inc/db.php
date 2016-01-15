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
      $this->pdo = new PDO("mysql:host=$server", $user, $pw);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected succesfully, ";

      $this->pdo->exec("CREATE DATABASE IF NOT EXISTS uniPages");
      $this->pdo->exec("use uniPages;");
      echo "Created DB, ";

      $dbinit = "CREATE TABLE IF NOT EXISTS profile (
        profileID INT NOT NULL AUTO_INCREMENT,
        first_name VARCHAR(20),
        surname  VARCHAR(40),
        university INT NOT NULL,
        password VARCHAR(20) NOT NULL,
        PRIMARY KEY(profileID)
      );
      CREATE TABLE IF NOT EXISTS university (
        uniID INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        description VARCHAR(400) NOT NULL,
        links VARCHAR(200),
        PRIMARY KEY(uniID)
      );
      CREATE TABLE IF NOT EXISTS group (
        groupID INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        description VARCHAR(400) NOT NULL,
        links VARCHAR(200) NOT NULL,
        PRIMARY KEY(groupID)
      );";
        $dbinit = trim($dbinit);
        $this->pdo->exec($dbinit);
        echo "Tables Loaded, ";

        $nRows = $this->pdo->query('select * from profile')->rowCount();
        echo $nRows . ", ";

        if ($nRows==0)
        {
          $data = "INSERT INTO university (name, description)
          VALUES ('University Of Portsmouth', 'Located in the center of the city of portsmouth');

          INSERT INTO profile (university, first_name, surname, password)
          VALUES (1, 'Thomas', 'George', 'root');";

          $data = trim($data);
          $this->pdo->exec($data);
          echo "Data Added, ";
        }

      }
      catch (PDOException $e) {
        echo "DB Error: ";
        print $e->getMessage();
      }
    }

  function query ($statement) {
    try{
      $results = $this->pdo->query($statement);
      echo "FETCHED, ";
      return $results->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
      echo "DB Error: ";
      print $e->getMessage();
    }
  }
}

?>
