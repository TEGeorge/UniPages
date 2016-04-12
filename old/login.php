<!doctype html>
<html>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <head>
     <title>UniPages</title>
  </head>

  <body>
    <?php include 'header.php'; ?>
    <script>
    var loginredirect = function () {
      request('GET', 'api/1/oauth/redirect', null, null, perform, null);
    };

    var perform = function (site) {
      window.location.href = site;
    }
    </script>
    <div class="row">
      <div class="col-sm-4 col-sm-offset-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Sign in</h3>
          </div>
            <img style="height:50px;width:200px;margin-top:10px;cursor:pointer;"
              onmouseover="this.src='src/btn_google_signin_focus.png';"
              onmouseout="this.src='src/btn_google_signin_normal.png';"
              onclick="this.src='src/btn_google_signin_pressed.png';loginredirect();"
              class="center-block" src="src/btn_google_signin_normal.png" alt="Google Sign in Button">
          <div class="panel-body">
            <form onsumbit='loginredirect();return false;'>
              <h3></h3>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
