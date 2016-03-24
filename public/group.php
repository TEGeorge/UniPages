<!doctype html>
<html>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="/lib/group.js"></script>
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
            <div class="panel panel-default">
              <div class="panel-heading">
                <?php include 'template/input-post.php'; ?>
              </div>
              <div id="posts-content" class="panel-body">
                <ul id="posts" class="list-unstyled">
                  <li><?php include 'template/post.php'; ?></li>
                </ul>
              </div>
            </div>
          </div>
          <div id="collegues" class="tab-pane">
            <div class="panel panel-default">
              <div id="collegues-content" class="panel-body">
                <ul id="results" class="list-unstyled">
                  <?php include 'template/search-result.php'; ?>
                  <?php include 'template/search-result.php'; ?>
                  <?php include 'template/search-result.php'; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-title">

            <h2 id="group-name" class="panel-heading">(Group Name) : (Group Type)</h2>

          </div>
          <div class="panel-body">

            <img src="profile.png" alt="" class="img-circle" style="width:100%; max-width:200px;">
            <dl id="group-details">

              <div class="group-uni" style="padding: 5px;">
                <dt >University:</dt>
                <dd><a href="#">UNI</a></dd>
              </div>

              <div class="group-info" style="padding: 5px;">
                <dt>Info:</dt>
                <dd><a href='#'>UNIT 1</a></dd>
              </div>

              <div class="group-links" style="padding: 5px;">
                <dt>Links:</dt>
                <dd><a href="#">RESOURCE 1</a></dd>
                <dd><a href="#">RESOURCE 2</a></dd>
              </div>
            </dl>

          </div>
        </div>
      </div>
    </div>
  </body>
</html>
