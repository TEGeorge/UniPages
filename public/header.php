<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if (!isset($_SESSION['authorised']) || $_SESSION['authorised'] == False) {
    header("Location: /login.php");
  }
  else if (!isset($_SESSION['login']) || $_SESSION['login'] === FALSE) {
    header("Location: /new/user.php");
  }
?>


<head>
  <link rel="stylesheet" type="text/css" href="public/mystyle.css">
  <script src="lib/general/classes.js"></script>
  <script src="lib/general/main.js"></script>
  <meta charset="UTF-8">
  <title>UniPages</title>
</head>

<header>
  <div class="contentBox">
    <h1><a href="/home.php">UniPages</a></h1>
    <div id="controls">
      <button onclick="get('/logout');return false;">Log out</button>
      <button onclick="location.href='/search.php';">Search</button>
      <button onclick="location.href='/new/group.php';">Create Group</button>
      <button onclick="location.href='/new/course.php';">Create Course</button>
    </div>
  </div>
</header>
</html>
