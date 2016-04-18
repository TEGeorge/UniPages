<?php


function isFile ($userfile) {
  if (isset($_FILES[$userfile]["name"]) && $_FILES[$userfile]["tmp_name"] != "") {
    return;
  }
  else {
    invalid('No file found');
  }
}

function pictureUpload($id) {
  isFile('picture');
  $name = $_FILES["picture"]["name"];
  $loc = $_FILES["picture"]["tmp_name"];
  $dir = $_SERVER['DOCUMENT_ROOT']."/public/picture/".$id;
  $ext = end(explode(".", $name));
  if ($ext!='jpg') {
    invalid('File must be jpg');
  }
  else if ($_FILES["picture"]["size"] > 1048576) {
    invalid('File is larger then 1mb');
  }
  else if ($_FILES["picture"]["error"] == 1) {
    invalid('Unknown error uploading picture');
  }
  if (file_exists($dir)) {
    unlink($dir);
  }
  $result = move_uploaded_file($loc, $dir);
  if (!$result) {
    invalid('Could not upload file');
  }
}

function repoUpload($id) {
  isFile(0);
  $dir = $_SERVER['DOCUMENT_ROOT']."/public/repo/";
  for ($i = 0; $i < count($_FILES); $i++) {
    $DB = new DB;
    $name = $_FILES[$i]["name"];
    $loc = $_FILES[$i]["tmp_name"];
    $sql = "INSERT INTO Repository (eid, name, size, type) VALUES (?, ?, ?, ?)";
    $bind = array($id, $name, $_FILES[$i]["size"], $_FILES[$i]["type"]);
    $result = $DB->insertQuery($sql, $bind);
    $result = move_uploaded_file($loc, $dir.$result);
    if (!$result) {
      invalid("Could not upload file");
    }
  }
  return true;
}

function getRepo($id) {
  $DB = new DB;
  $sql = 'SELECT * FROM Repository WHERE eid = ?';
  $bind = array($id);
  $result = $DB -> query($sql, $bind);
  return $result;
}

function getFile($id) {
  return $_SERVER['DOCUMENT_ROOT']."/public/repo/".$id;
}

function invalid ($msg) {
  $meta['status'] = 403;
  $meta['success'] = false;
  $meta['msg'] = $msg;
  send($meta);
}

 ?>
