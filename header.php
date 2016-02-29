
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="lib/uniPages.js"></script>
    <script src="lib/classes.js"></script>
    <div class="jumbotron" style="padding:10px;">
      <h1 style="display:inline;"><a href="home.php">UniPages</a></h1>
      <button type="button" class="btn btn-default" style="float:right;" onclick="request('GET', 'api/1/logout');window.location.href='/login.php';">
        <span class="glyphicon glyphicon-log-out"></span>
      </button>
    </div>
  </body>
</html>
