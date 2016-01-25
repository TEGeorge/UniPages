<?php

/*
Re-usable database utilities in PDO
(c) C Lester 2013 (mysqli), 2014 (PDO)
*/

include __DIR__.'/dbinit.php';

class DB
{

  function __construct () {
    $server = "localhost";
    $user = "root";
    $pw = "root";

    try {
        $this->pdo = new PDO("mysql:host=$server", $user, $pw);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected succesfully, ";

        $this->pdo->exec("CREATE DATABASE IF NOT EXISTS uniPages");
        $this->pdo->exec("use uniPages;");
      //echo "Created DB, ";

        $this->pdo->exec(DBINIT); //CREATE TABLES
        //echo "Tables Loaded, ";

        $nRows = $this->pdo->query('select * from university')->rowCount(); //INSERT DUMMY DATA IF NO DATA
        //echo $nRows . ", ";

        if ($nRows==0)
        {
          $this->pdo->exec(DUMMYDATA);
          //echo "Data Added, ";
        }

      }
      catch (PDOException $e) {
        //echo "DB Error: ";
        print $e->getMessage();
      }
    }

  function query ($statement) {
    try{
      $sth = $this->pdo->prepare($statement);
      $sth->execute();
      //echo "FETCHED, ";
      $result = array();
      $result = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    catch (PDOException $e) {
      //echo "DB Error: ";
      print $e->getMessage();
    }
  }
}

?>
