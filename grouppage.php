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
    <div class="row">
      <div class="col-sm-8">
        <ul class="nav nav-tabs nav-justified">
          <li role="dynamic" class="active"><a data-toggle="tab" href="#posts">Posts</a></li>
          <li role="dynamic"><a data-toggle="tab" href="#collegues">Collegues</a></li>
        </ul>
        <div class="tab-content">
          <div id="posts" class="tab-pane active">
          </div>
          <div id="collegues" class="tab-pane">
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-title">
            <h2 class="panel-heading">Group Name</h2>
          </div>
          <div class="panel-body">
            <form role="form">
             <div class="form-group">
               <label for="Name">Details</label>
             </div>
             <div class="form-group">
               <label for="pwd">Info</label>
             </div>
             <div class="form-group">
               <label for="pwd">Resource:</label>
             </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
