<?php

  function getUniversity($id) {
    $DB = new DB;
    $bind = array($id);
    $sql = 'SELECT * FROM University WHERE id = ?';
    $result = $DB -> query($sql, $bind);
    return $result[0];
  }

  function getCourse($id) {
    $DB = new DB;
    $bind = array($id);
    $sql = 'SELECT * FROM Course WHERE id = ?';
    $result = $DB -> query($sql, $bind);
    if (!isset($result[0])) {
      return null;
    }
    $result = $result[0];
    $result['university'] = getUniversity($result['university']);
    return $result;
  }

  function getProfile($id) {
    $DB = new DB;
    $bind = array($id);
    $sql = 'SELECT id, eid, fname, surname, university, course, bio, privacy FROM Profile where id = ?';
    $result = $DB -> query($sql, $bind);
    $result = $result[0];
    $result['university'] = getUniversity($result['university']);
    $result['course'] = getCourse($result['course']);
    return $result;
  }

  function getSurfaceProfile ($id) {
    $result = getProfile($id);
    if (is_null($result)) {
      return null;
    }
    $profile['id'] = $result['id'];
    $profile['eid'] = $result['eid'];
    $profile['fname'] = $result['fname'];
    $profile['surname'] = $result['surname'];
    $profile['university'] = $result['university'];
    $profile['course']= $result['course'];
    $profile['privacy'] = $result['privacy'];
    return $profile;
  }

  //NOT FINISHED
  function getProfiles () {
    $DB = new DB;
    $bind = array($_SESSION['user']['university']['id']);
    $sql = 'SELECT id FROM Profile WHERE university = ?'; //BINDING IS NOT WORKING
    $result = $DB -> query($sql, $bind);
    $profiles = array();
    $i = 0;
    foreach($result as $profile) {
      $profile = getSurfaceProfile($profile['id']);
      if(profileAuth($profile)) {
        array_push($profiles, $profile);
      }
    }
    return (object)$profiles;
  }

  function getGroup($id) {
    $DB = new DB;
    $bind = array($id);
    $sql = 'SELECT * FROM `Group` WHERE id = ?';
    $result = $DB -> query($sql, $bind);
    $result = $result[0];
    $result['university'] = getUniversity($result['university']);
    if (!is_null($result['course'])) {
      $result['course'] = getCourse($result['course']);
      $result['unit'] = isUnit($id);
    }
    return $result;
  }

  //CHECK FOR NO RESULTS ON ALL SELECTS?
  //NEEDS LOTS OF TESTING FOR WHAT AN EMPTY ASSOC ARRAY LOOKS LIKE
  function isUnit($id) {
    $DB = new DB;
    $bind = array($id);
    $sql = 'SELECT * FROM Unit WHERE group = ?';
    $result = $DB -> query($sql, $bind);
    if ($count($result) === 0) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  function authorised($eid) {
    $result = getEntity($eid);
    switch($result['type']) {
      case 'group':
        return groupAuth($result['entity']);
      break;
      case 'profile':
        return profileAuth($result['entity']);
      break;
      case 'course':
        return courseAuth($result['entity']);
      break;
      case 'university':
        return universityAuth($result['entity']);
      break;
    }
  }

  //NEEDS TO CHECK MEMBERSHIP AND COURSE
  function groupAuth($id) {
    $result = getGroup($id);
    if ($result['university']['id']===$_SESSION['user']['university']['id']) {
      return TRUE;
    }
    return FALSE;
  }

  //Check course and access level
  function profileAuth($profile) {
    $access = $profile['privacy'];
    if ($access=0) {
      return FALSE;
    }
    else if ($profile['university']['id']===$_SESSION['user']['university']['id'] && $access=3) {
      return TRUE;
    }
    //COURSE & ACCESS = 2
    //GROUP & ACCESS = 1
    return FALSE;
  }

  //Check course?
  function courseAuth($course) {
    if ($course['id']===$_SESSION['user']['course']['id']) {
      return TRUE;
    }
    return FALSE;
  }

  function universityAuth($university) {
    if ($university['university']['id']===$_SESSION['user']['university']['id']) {
      return TRUE;
    }
    return FALSE;
  }

  function getEntity($eid) {
    $DB = new DB;
    $bind = array($eid);
    $sql = 'SELECT type, entity FROM Entity where id = ?';
    $result = $DB -> query($sql, $bind);
    return $result[0];
  }

  function getEntityId($id, $type) {
    $DB = new DB;
    $bind = array($type, $id);
    $sql = 'SELECT id FROM Entity WHERE type=? AND entity=?';
    $result = $DB -> query($sql, $bind);
    return $result[0]['id'];
  }

  function getTargetPosts($id, $type, $offset = 0, $limit = 20) {
    $entity = getEntityId($id, $type);
    $DB = new DB;
    $bind = array($entity);
    $sql = 'SELECT * FROM Post WHERE target = ? ORDER BY updated DESC'; //LIMIT ? ? MISSING
    $result = $DB -> query($sql, $bind);
    foreach ($result as $post) {
      $post = getPostInfo($post);  //DO CHANGES TO POST CHANGE RESULT ARRAY??????
      $post['comments'] = getComments($post['id']);
    }
    return $result;
  }

  function getAuthorPosts($id, $offset = 0, $limit = 20) {
    $DB = new DB;
    $bind = array($id);
    $sql = 'SELECT * FROM Post WHERE author = ? ORDER BY updated DESC';
    $result = $DB -> query($sql, $bind);
    foreach ($result as $post) {
      $post = getPostInfo($post);  //DO CHANGES TO POST CHANGE RESULT ARRAY??????
      $post['comments'] = getComments($post['id']);
    }
    return $result;
  }

  function getPostInfo($post) {
    $entity = getEntity($post['target']);
    switch($entity['type']) {
      case 'group':
        $post['target'] = getGroup($entity['id']);
      break;
      case 'profile':
        $post['target'] = getProfile($entity['id']);
      break;
      case 'course':
        $post['target'] = getCourse($entity['id']);
      break;
      case 'university':
        $post['target'] = getUniversity($entity['id']);
      break;
    }
    $post['author'] = getProfile($post['author']);
    return $post;
  }

  function getComments($id) {
    $DB = new DB;
    $bind = array($id);
    $sql = 'SELECT * FROM Comment WHERE post = ? ORDER BY created DESC';
    $result = $DB -> query($sql, $bind);
    foreach ($result as $comment) {
      $comment['author'] = getProfile($comment['author']);
    }
    return $result;
  }

  function newPost($data) {
    $DB = new DB;
    if(!isset($data['isquestion'])) {$data['isquestion'] = 0;}
    $bind = array ($data['author'], $data['target'], $data['isquestion'], $data['content']);
    $sql = 'INSERT INTO Post (author, target, updated, isquestion, content) VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?)';
    $id = $DB -> insertQuery($sql, $bind);
  }

  function newComment($data) {
    $DB = new DB; //VALID POST?
    $bind = array ($data['post'], $data['author'], $data['content']);
    $sql = 'INSERT INTO Comment (post, author, content) VALUES (?, ?, ?)';
    $id = $DB -> insertQuery($sql, $bind);
  }

  function newProfile($data) {
    $DB = new DB;
    $sql = "INSERT INTO Entity (type) VALUES ('profile');";
    $entity = $DB -> insertQuery($sql);
    $bind = array($entity, $data['fname'], $data['surname'], $data['email'], $data['university'], $data['course'], $data['bio'], $data['privacy']);
    $sql = "INSERT INTO Profile (eid, fname, surname, email, university, course, bio, privacy)
      VALUES (?, ?, ?, ?, ?, ?, ? ,? ,?);";
    $id = $DB -> insertQuery($sql, $bind);
    $sql = 'UPDATE Entity
      SET entity=?
      WHERE id=?;';
    $bind = array($id, $entity);
    $entity = $DB -> insertQuery($sql);
  }

  function newCourse($data) {
    $DB = new DB;
    $sql = "INSERT INTO Entity (type) VALUES ('course');";
    $entity = $DB -> insertQuery($sql);
    $bind = array($entity, $data['name'], $data['description'], $data['university']);
    $sql = "INSERT INTO Course (eid, name, description, university)
      VALUES (?, ?, ?, ?);";
    $id = $DB -> insertQuery($sql);
    $sql = 'UPDATE Entity
      SET entity=?
      WHERE id=?;';
    $bind = array($id, $entity);
    $entity = $DB -> insertQuery($sql);
  }

  function newUniversity($data) {
    $DB = new DB;
    $sql = "INSERT INTO Entity (type) VALUES ('university');";
    $entity = $DB -> insertQuery($sql);
    $bind = array($entity, $data['name'], $data['description']);
    $sql = "INSERT INTO Profile (eid, name, description)
      VALUES (?, ?, ?);";
    $id = $DB -> insertQuery($sql);
    $sql = 'UPDATE Entity
      SET entity=?
      WHERE id=?;';
    $bind = array($id, $entity);
    $entity = $DB -> insertQuery($sql);
  }



  /*
$DB = new DB;
$sql = '';
$result = $DB -> query($sql);
return $result[0];
 */
 ?>
