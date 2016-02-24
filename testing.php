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
    var redirect = function () {
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
            <h3 class="panel-title">Log In</h3>
          </div>
          <div class="panel-body">
            <form onsumbit='redirect();return false;'>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default">Submit</button>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-default">New User</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>