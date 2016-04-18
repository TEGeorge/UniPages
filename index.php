<?php
  session_start();
  if (!isset($_SESSION['authorised']) || $_SESSION['authorised'] == False) {
    header("Location: /login.php");
  }
  else if (!isset($_SESSION['login']) || $_SESSION['login'] === FALSE) {
    header("Location: /new/user.php");
  }
?>
