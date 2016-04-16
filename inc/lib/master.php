<?php

  function searchProfile($string)
  {
      $DB = new DB();
      $bind = array('%'.$string.'%', '%'.$string.'%');
      $sql = 'SELECT id, eid, fname, surname, bio FROM Profile WHERE fname LIKE ? OR surname LIKE ?';
      $result = $DB->query($sql, $bind);
      $DB->close();
      return $result;
  }

  function getUniversities()
  {
      $DB = new DB();
      $sql = 'SELECT id, name FROM University';
      $result = $DB->query($sql);
      $DB->close();
      return $result;
  }

  function getCourses($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT id, name FROM Course WHERE university = ?';
      $result = $DB->query($sql, $bind);
      $DB->close();
      return $result;
  }

  function searchGroup($string)
  {
      $DB = new DB();
      $bind = array('%'.$string.'%');
      $sql = 'SELECT id, eid, name, description FROM `Group` WHERE name LIKE ?';
      $result = $DB->query($sql, $bind);
      $DB->close();
      return $result;
  }

  function getUniversity($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT * FROM University WHERE id = ?';
      $result = $DB->query($sql, $bind);
      if (!isset($result[0])) {
          return;
      }
      $DB->close();
      return $result[0];
  }

  function getUser($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT * FROM Profile WHERE id = ?';
      $result = $DB->query($sql, $bind);
      if (!isset($result[0])) {
          return;
      }
      $result = $result[0];
      $result['university'] = getUniversity($result['university']);
      $result['course'] = getCourse($result['course']);
      $result['groups'] = getUserGroups($id);
      $DB->close();
      return $result;
  }

  function getUserGroups($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT * FROM Membership WHERE profile = ?';
      $result = $DB->query($sql, $bind);
      if (!isset($result[0])) {
          return;
      }
      $groups = array();
      foreach ($result as $group) {
          $entity = getEntity($group['entity']);
          $group = getGroupInfo($entity['entity']);
          $group['owner'] = false;
          if ($group['owner'] === $_SESSION['user']['id']) {
              $group['owner'] = true;
          }
          array_push($groups, $group);
      }
      $DB->close();
      return $groups;
  }

  function getCourse($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT * FROM Course WHERE id = ?';
      $result = $DB->query($sql, $bind);
      if (!isset($result[0])) {
          return;
      }
      $result = $result[0];
      $result['university'] = getUniversity($result['university']);
      $result['units'] = getUnits($id);
      $DB->close();
      return $result;
  }

  function getProfile($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT id, eid, fname, surname, university, course, bio, privacy FROM Profile WHERE id = ?';
      $result = $DB->query($sql, $bind);
      if (!isset($result[0])) {
          return;
      }
      $result = $result[0];
      $result['university'] = getUniversity($result['university']);
      $result['course'] = getCourse($result['course']);
      $DB->close();
      return $result;
  }

  function getSurfaceProfile($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT id, eid, fname, surname FROM Profile WHERE id = ?';
      $result = $DB->query($sql, $bind);
      if (is_null($result[0])) {
          return;
      }
      $DB->close();
      return $result[0];
  }

  function getDebugProfiles() {
    $DB = new DB();
    $sql = 'SELECT * FROM Profile'; //BINDING IS NOT WORKING
    $result = $DB->query($sql);
    $DB->close();
    return $result;
  }

  function getProfiles()
  {
    $DB = new DB();
    $bind = array((int) $_SESSION['user']['university']['id']);
    $sql = 'SELECT id FROM Profile WHERE university = ?'; //BINDING IS NOT WORKING
    $result = $DB->query($sql, $bind);
    $profiles = array();
    $i = 0;
    foreach ($result as $profile) {
      $profile = getSurfaceProfile($profile['id']);
      if (profileAuth($profile)) {
          array_push($profiles, $profile);
      }
    }
    $DB->close();
    return (object) $profiles;
  }

  function getUnits($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT * FROM `Group` WHERE isunit =1 AND course = ?';
      $result = $DB->query($sql, $bind);
      $DB->close();
      return $result;
  }

  function getGroup($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT * FROM `Group` WHERE id = ?';
      $result = $DB->query($sql, $bind);
      $result = $result[0];
      $result['university'] = getUniversity($result['university']);
      if (!is_null($result['course'])) {
          $result['course'] = getCourse($result['course']);
      }
      if ($result['owner'] === $_SESSION['user']['id']) {
          $result['owner'] = true;
      } else {
          $result['owner'] = false;
      }
      $DB->close();
      return $result;
  }

  function getGroupInfo($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT * FROM `Group` WHERE id = ?';
      $result = $DB->query($sql, $bind);
      $result = $result[0];
      $DB->close();
      return $result;
  }

  function authorised($eid)
  {
      $result = getEntity($eid);
      switch ($result['type']) {
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
  function groupAuth($id)
  {
      $result = getGroup($id);
      if (isMember($result['eid'])) {
          return true;
      }

      return false;
  }

  function isMember($eid)
  {
      $DB = new DB();
      $sql = 'SELECT * FROM Membership WHERE profile = ? AND entity = ?';
      $bind = array($_SESSION['user']['id'], $eid);
      $result = $DB->query($sql, $bind);
      if (is_null($result[0])) {
          return false;
      }
      $DB->close();
      return true;
  }

  //Check course and access level
  function profileAuth($id)
  {
      $profile = getProfile($id);
      $access = $profile['privacy'];
      if ($profile['university']['id'] === $_SESSION['user']['university']['id']) {
          return true;
      }
    //COURSE & ACCESS = 2
    //GROUP & ACCESS = 1
    return false;
  }

  //Check course?
  function courseAuth($id)
  {
      $course = getCourse($id);
      if ($course['id'] === $_SESSION['user']['course']['id']) {
          return true;
      }

      return false;
  }

  function universityAuth($id)
  {
      $university = getUniversity($id);
      if ($university['id'] === $_SESSION['user']['university']['id']) {
          return true;
      }

      return false;
  }

  function getEntity($eid)
  {
      $DB = new DB();
      $bind = array($eid);
      $sql = 'SELECT type, entity FROM Entity where id = ?';
      $result = $DB->query($sql, $bind);

      return $result[0];
  }

  function getEntityId($id, $type)
  {
      $DB = new DB();
      $bind = array($type, $id);
      $sql = 'SELECT id FROM Entity WHERE type=? AND entity=?';
      $result = $DB->query($sql, $bind);
      $DB->close();
      return $result[0]['id'];
  }

  function getPost($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT * FROM Post WHERE id = ?';
      $result = $DB->query($sql, $bind);
      if (is_null($result[0])) {
          return;
      }
      $DB->close();
      return getPostInfo($result[0]);
  }

  function getComment($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT * FROM Comment WHERE id = ?';
      $result = $DB->query($sql, $bind);
      if (is_null($result)) {
          return;
      }
      $DB->close();
      return $result[0];
  }

  function getTargetPosts($id, $type, $offset = 0, $limit = 20)
  {
      $entity = getEntityId($id, $type);
      if (!authorised($entity)) {
          $meta['status'] = 401;
          $meta['msg'] = 'Unauthorised, you are not a member of this group';
          send($meta, false);
      }
      $DB = new DB();
      $bind = array($entity);
      $sql = 'SELECT * FROM Post WHERE target = ? ORDER BY updated DESC'; //LIMIT ? ? MISSING
    $result = $DB->query($sql, $bind);
      if (is_null($result)) {
          return;
      }
      $posts = array();
      foreach ($result as $post) {
          $post = getPostInfo($post);  //DO CHANGES TO POST CHANGE RESULT ARRAY??????
      $post['comments'] = getComments($post['id']);
          array_push($posts, $post);
      }
      $DB->close();
      return $posts;
  }

  function getAuthorPosts($id, $offset = 0, $limit = 20)
  {
      $DB = new DB();
      if (!profileAuth($id)) {
          return;
      }
      $bind = array($id);
      $sql = 'SELECT * FROM Post WHERE author = ? ORDER BY updated DESC';
      $result = $DB->query($sql, $bind);
      if (is_null($result)) {
          return;
      }
      $posts = array();
      foreach ($result as $post) {
          $post = getPostInfo($post);  //DO CHANGES TO POST CHANGE RESULT ARRAY??????
      $post['comments'] = getComments($post['id']);
          array_push($posts, $post);
      }
      $DB->close();
      return $posts;
  }

  function getPostInfo($post)
  {
      $entity = getEntity($post['target']);
      switch ($entity['type']) {
      case 'group':
        $post['target'] = getGroup($entity['entity']);
      break;
      case 'profile':
        $post['target'] = getSurfaceProfile($entity['entity']);
      break;
      case 'course':
        $post['target'] = getCourse($entity['entity']);
      break;
      case 'university':
        $post['target'] = getUniversity($entity['entity']);
      break;
    }
      $post['author'] = getSurfaceProfile($post['author']);

      return $post;
  }

  function getComments($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'SELECT * FROM Comment WHERE post = ? ORDER BY created ASC';
      $result = $DB->query($sql, $bind);
      if (is_null($result)) {
          return $result;
      }
      $comments = array();
      foreach ($result as $comment) {
          $comment['author'] = getSurfaceProfile($comment['author']);
          array_push($comments, $comment);
      }
      $DB->close();
      return $comments;
  }

  function newPost($data)
  {
      $DB = new DB();
      if (!authorised($data['target'])) {
          return;
      }
      if (!isset($data['isquestion'])) {
          $data['isquestion'] = 0;
      }
      $bind = array($_SESSION['user']['id'], $data['target'], $data['isquestion'], $data['content']);
      $sql = 'INSERT INTO Post (author, target, updated, isquestion, content) VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?)';
      $id = $DB->insertQuery($sql, $bind);
      $DB->close();
      return getPost($id);
  }

  function newComment($post, $data)
  {
      $DB = new DB();
      $result = getPost($post);
      if (!authorised($result['target']['eid'])) {
          return;
      }
      $bind = array($post, $_SESSION['user']['id'], $data['content']);
      $sql = 'INSERT INTO Comment (post, author, content) VALUES (?, ?, ?)';
      $id = $DB->insertQuery($sql, $bind);
      updatePost($post);
      $DB->close();
      return getComment($id);
  }

  function updatePost($id)
  {
      $DB = new DB();
      $bind = array($id);
      $sql = 'UPDATE Post
              SET updated=NOW()
              WHERE id=?;';
      $result = $DB->insertQuery($sql, $bind);
      $DB->close();
  }

  function newProfile($data)
  {
      $DB = new DB();
      $sql = "INSERT INTO Entity (type) VALUES ('profile');";
      $entity = $DB->insertQuery($sql);
      $bind = array($entity, $data['fname'], $data['surname'], $data['email'], $data['university'], $data['course'], $data['bio'], $data['privacy']);
      $sql = 'INSERT INTO Profile (eid, fname, surname, email, university, course, bio, privacy)
      VALUES (?, ?, ?, ?, ?, ?, ? ,?);';
      $id = $DB->insertQuery($sql, $bind);
      $sql = 'UPDATE Entity
      SET entity=?
      WHERE id=?;';
      $bind = array($id, $entity);
      $entity = $DB->insertQuery($sql, $bind);
      $sql = 'INSERT INTO Login (id, profile) VALUES (?, ?)';
      $bind = array($_SESSION['sub'], $id);
      $result = $DB->insertQuery($sql, $bind);
      $login['profile'] = $id;
      login($login);
      $DB->close();
  }

  function newGroup($data)
  {
      $DB = new DB();
      $sql = "INSERT INTO Entity (type) VALUES ('group');";
      $entity = $DB->insertQuery($sql);
      if (isset($data['user']['course'])) {
          $course = $_SESSION['user']['course']['id'];
      } else {
          $course = null;
      }
      $bind = array($entity, $data['name'], $data['description'], $_SESSION['user']['university']['id'], $course, $data['isprivate'], $data['isunit'], $_SESSION['user']['id']);
      $sql = 'INSERT INTO `Group` (eid, name, description, university, course, isprivate, isunit, owner)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?);';
      $id = $DB->insertQuery($sql, $bind);
      $sql = 'UPDATE Entity SET entity=? WHERE id=?;';
      $bind = array($id, $entity);
      $entity = $DB->insertQuery($sql, $bind);
      joinGroup($id);
      $DB->close();
      return $entity;
  }

  function joinGroup($id)
  {
      $DB = new DB();
      $entity = getGroup($id);
      $sql = 'INSERT INTO Membership (profile, access, entity) VALUES(?, ?, ?)';
      $bind = array($_SESSION['user']['id'], '1', $entity['eid']);
      $success = $DB->insertQuery($sql, $bind);
      $DB->close();
  }

  function leaveGroup($id)
  {
      $DB = new DB();
      $entity = getGroup($id);
      $sql = 'DELETE FROM Membership WHERE profile=? AND entity=?;';
      $bind = array($_SESSION['user']['id'], $entity['eid']);
      $success = $DB->insertQuery($sql, $bind);
      $DB->close();
  }

  function newCourse($data)
  {
      $DB = new DB();
      $sql = "INSERT INTO Entity (type) VALUES ('course');";
      $entity = $DB->insertQuery($sql);
      $bind = array($entity, $data['name'], $data['description'], $_SESSION['user']['university']['id']);
      $sql = 'INSERT INTO Course (eid, name, description, university)
      VALUES (?, ?, ?, ?);';
      $id = $DB->insertQuery($sql, $bind);
      $sql = 'UPDATE Entity
      SET entity=?
      WHERE id=?;';
      $bind = array($id, $entity);
      $entity = $DB->insertQuery($sql, $bind);
      $sql = 'UPDATE Profile
              SET course=?
              WHERE id=?;';
      $bind = array($id, $_SESSION['user']['id']);
      $update = $DB->insertQuery($sql, $bind);
      $DB->close();
  }

  function newUniversity($data)
  {
      $DB = new DB();
      $sql = "INSERT INTO Entity (type) VALUES ('university');";
      $entity = $DB->insertQuery($sql);
      $bind = array($entity, $data['name'], $data['description']);
      $sql = 'INSERT INTO Profile (eid, name, description)
      VALUES (?, ?, ?);';
      $id = $DB->insertQuery($sql);
      $sql = 'UPDATE Entity
      SET entity=?
      WHERE id=?;';
      $bind = array($id, $entity);
      $entity = $DB->insertQuery($sql);
      $DB->close();
  }
