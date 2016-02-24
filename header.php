
<html>
  <?php
  session_start();
  if(!isset($_SESSION['login'])){
    if ($_SERVER['REQUEST_URI']!='/login.php' && $_SERVER['REQUEST_URI']!='/newuser.php')
    {
      header("Location: login.php");
    }
  }

   ?>
  <body>
    <script src="lib/uniPages.js"></script>
    <script src="lib/classes.js"></script>
    <div class="jumbotron" style="padding:10px;">
      <h1 style="display:inline;"><a href="home.php">UniPages</a></h1>
      <button type="button" class="btn btn-default" style="float:right;" onclick="request('GET', 'api/1/logout');">
        <span class="glyphicon glyphicon-log-out"></span>
      </button>
    </div>
  </body>
</html>
