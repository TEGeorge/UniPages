
<html>
  <?php
  session_start();
  if(!isset($_SESSION['login'])){
    if ($_SERVER['REQUEST_URI']!='/login.php')
    {
      header("Location: login.php");
    }
  }

   ?>
  <body>
    <script src="lib/uniPages.js"></script>
    <div class="jumbotron" style="padding:10px;">
      <h1><a href="home.php">UniPages</a></h1>
    </div>
  </body>
</html>
