<?php

/*
Re-usable database utilities in PDO
(c) C Lester 2013 (mysqli), 2014 (PDO)
*/

include __DIR__.'/init.php';

class DB
{

  function __construct () {
    $server = "localhost";
    $user = "root";
    $pw = "root";

    try {
        $this->pdo = new PDO("mysql:host=$server", $user, $pw);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("CREATE DATABASE IF NOT EXISTS uniPages");
        $this->pdo->exec("use uniPages;");

        $this->pdo->exec(DBINIT); //CREATE TABLES
        //INSERT DUMMY DATA IF NO DATA
        $nRows = $this->pdo->query('SELECT *
          FROM university
          LIMIT 1')->rowCount();

        if ($nRows==0)
        {
          $this->pdo->exec(DUMMYDATA);
        }
      }
      catch (PDOException $e) {
        $meta = [];
        $meta['success'] = false;
        $meta['msg'] = $e->getMessage();
        $meta['status'] = 503;
        $meta['debug'] = 'Failure on database connection';
        send($meta);
        exit;
      }
    }

  public function query ($statement, $bind = null) {
    try{
      $sth = $this->pdo->prepare($statement);
      $sth->execute($bind);
      return $sth->fetchAll(PDO::FETCH_ASSOC);
      //return $sth ->rowCount();
    }
    catch (PDOException $e) {
      $meta['success'] = false;
      $meta['msg'] = $e->getMessage();
      $meta['status'] = 400;
      $meta['query'] = $statement;
      $meta['bindings'] = $bindings;
      send ($meta);
      exit;
    }
  }

  public function close() {
    $this->pdo = null;
  }

  public function lastId() {
    return $this->pdo->lastInsertId();
  }
}

?>
