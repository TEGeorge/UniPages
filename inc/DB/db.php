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
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
        $this->pdo->exec("CREATE DATABASE IF NOT EXISTS uniPages");
        $this->pdo->exec("use uniPages;");

        $this->pdo->exec(DBINIT); //CREATE TABLES


        $nRows = $this->pdo->query('SELECT *
          FROM University
          LIMIT 1')->rowCount();
        if ($nRows==0) //INSERT DUMMY DATA IF NO DATA
        {
          $id = $this->dummyUniversity();
          $this->nullCourse($id);
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

  private function dummyUniversity() {
    $sql = "INSERT INTO Entity (type) VALUES ('university');";
    $entity = $this->insertQuery($sql);
    $bind = array($entity, 'University Of Portsmouth', 'Located in the heart of portsmouth');
    $sql = 'INSERT INTO University (eid, name, description)
    VALUES (?, ?, ?);';
    $id = $this->insertQuery($sql, $bind);
    $sql = 'UPDATE Entity
    SET entity=?
    WHERE id=?;';
    $bind = array($id, $entity);
    $entity = $this->insertQuery($sql);
    return $id;
  }

  private function nullCourse($uniId) {
    $sql = "INSERT INTO Entity (type) VALUES ('course');";
    $entity = $this->insertQuery($sql);
    $bind = array($entity, 'General', 'General course for those whose course does not exists yet', $uniId);
    $sql = 'INSERT INTO Course (eid, name, description, university)
    VALUES (?, ?, ?, ?);';
    $id = $this->insertQuery($sql, $bind);
    $sql = 'UPDATE Entity
    SET entity=?
    WHERE id=?;';
    $bind = array($id, $entity);
    $this->insertQuery($sql, $bind);
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
      $meta['bindings'] = $bind;
      send ($meta);
      exit;
    }
  }

  public function close() {
    $this->pdo = null;
  }

  public function insertQuery($statement, $bind = null) {
    try{
      $sth = $this->pdo->prepare($statement);
      $sth->execute($bind);
      return $this->pdo->lastInsertId();
    }
    catch (PDOException $e) {
      $meta['success'] = false;
      $meta['msg'] = $e->getMessage();
      $meta['status'] = 400;
      $meta['query'] = $statement;
      $meta['bindings'] = $bind;
      $meta['debug'] = 'Invalid POST data';
      send ($meta);
      exit;
    }
  }

  }

?>
