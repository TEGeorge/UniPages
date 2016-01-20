<!doctype html>
<html>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <head>
  <script src="lib/format.js"></script>
  <script src="lib/home.js"></script>
  <script src="lib/uniPages.js"></script>
     <title>UniPages</title>
  </head>

  <body>
    <?php include 'header.php'; ?>
    <div class="row">
      <div class="col-sm-8">
        <ul class="nav nav-tabs nav-justified">
          <li role="dynamic" class="active"><a data-toggle="tab" href="#posts">Posts</a></li>
          <li role="dynamic"><a data-toggle="tab" href="#university">University</a></li>
          <li role="dynamic"><a data-toggle="tab" href="#course">Course</a></li>
          <li role="dynamic"><a data-toggle="tab" href="#groups">Groups</a></li>
          <li role="dynamic"><a data-toggle="tab" href="#search">Search</a></li>
        </ul>
        <div class="tab-content">

          <div id="posts" class="tab-pane active">
            <div class="panel panel-default">
              <div class="panel-heading">

                <?php include 'template/input-post.php'; ?>

              </div>
              <div id="" class="panel-body">
                <ul id="posts-content" class="list-unstyled">

                  <?php include 'template/post.php'; ?>

                </ul>
              </div>
            </div>
          </div>

          <div id="university" class="tab-pane">
            <div class="panel panel-default">
              <div class="panel-heading">

                <?php include 'template/input-post.php'; ?>

              </div>
              <div id="university-content" class="panel-body">
                <ul id="posts" class="list-unstyled">

                  <li><?php include 'template/post.php'; ?></li>

                </ul>
              </div>
            </div>
          </div>

          <div id="course" class="tab-pane">
            <div class="panel panel-default">
              <div class="panel-heading">

                <?php include 'template/input-post.php'; ?>

              </div>
              <div id="course-content" class="panel-body">
                <ul id="posts" class="list-unstyled">

                  <li><?php include 'template/post.php'; ?></li>

                </ul>
              </div>
            </div>
          </div>

          <div id="groups" class="tab-pane">
            <div class="panel panel-default">
              <div id="groups-content" class="panel-body">
                <ul id="posts" class="list-unstyled">

                  <li><?php include 'template/post.php'; ?></li>

                </ul>
              </div>
            </div>
          </div>

          <div id="search" class="tab-pane">
            <div class="panel panel-default">
              <div class="panel-heading">

                <?php include 'template/input-search.php'; ?>

              </div>
              <div id="search-content" class="panel-body">
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

      <div id="profile" class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-heading">

            <h2 id="profile-name">(STUDENT NAME) : (STUDENT NUMBER)</h2>

          </div>
          <div class="panel-body">
            <img src="profile.png" alt="" class="img-circle" style="width:100%; max-width:200px;">
            <dl id="profile-details">

              <div class="university" style="padding: 5px;">
                <dt >University:</dt>
                <dd><a id="profile-university" href="#">UNI NAME</a></dd>
              </div>

              <div class="course" style="padding: 5px;">
                <dt >Course:</dt>
                <dd><a id="profile-course" href="#">COURSE NAME</a></dd>
              </div>

              <div class="profile-unit" style="padding: 5px;">
                <dt>Units:</dt>
                <dd><a href="#">UNIT 1</a></dd>
                <dd><a href="#">UNIT 2</a></dd>
                <dd><a href="#">UNIT 3</a></dd>
                <dd><a href="#">UNIT 4</a></dd>
              </div>

              <div class="profile-social" style="padding: 5px;">
                <dt>Social Media:</dt>
                <dd><a href="#">SOCIAL MEDIA SITE 1</a></dd>
                <dd><a href="#">SOCIAL MEDIA SITE 2</a></dd>
              </div>

              <div class="profile-groups" style="padding: 5px;">
                <dt>Groups:</dt>
                <dd><a href="#">GROUP 1</a></dd>
                <dd><a href="#">GROUP 2</a></dd>
              </div>

            </dl>
          </div>
        </div>
      </div>

    </div>
  </body>
</html>
