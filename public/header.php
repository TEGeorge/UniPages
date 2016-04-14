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
      <button>Manage Account</button>
      <button onclick="location.href='http://localhost:8080/search.php';">Search</button>
      <button onclick="location.href='http://localhost:8080/new/group.php';">New Group</button>
    </div>
  </div>
</header>
</html>
