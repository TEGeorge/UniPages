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
        <div id="posts">
          <div class="panel panel-default">
            <div class="panel-heading">

              <?php include 'template/input-post.php'; ?>

            </div>
            <div id="posts-content" class="panel-body">
              <ul id="posts-list" class="list-unstyled">

                <li><?php include 'template/post.php'; ?></li>

              </ul>
            </div>
          </div>
        </div>
      </div>
      <div id="profile" class="col-sm-4">
        <div class="panel panel-default">
          <div class="panel-heading">

            <h2 id="profile-name">Joe Bloggs : 719079</h2>

          </div>
          <div class="panel-body">
            <img src="profile.png" alt="" class="img-circle" style="width:100%; max-width:200px;">
            <dl id="profile-details">

              <div class="profile-university" style="padding: 5px;">
                <dt >University:</dt>
                <dd>
                  <a href="#">University Of Portsmouth</a>
                </dd>
              </div>

              <div class="profile-course" style="padding: 5px;">
                <dt >Course:</dt>
                <dd>
                  <a href="#">(BSc) Computer Science (2015)</a>
                </dd>
              </div>

              <div class="profile-unit" style="padding: 5px;">
                <dt>Units:</dt>
                <dd>
                  <a href="#">UNIT 1</a>
                </dd>
                <dd>
                  <a href="#">UNIT 2</a>
                </dd>
                <dd>
                  <a href="#">UNIT 3</a>
                </dd>
                <dd>
                  <a href="#">UNIT 4</a>
                </dd>
              </div>

              <div class="profile-social" style="padding: 5px;">
                <dt>Social Media:</dt>
                <dd>
                  <a href="#">SOCIAL MEDIA SITE 1</a>
                </dd>
                <dd>
                  <a href="#">SOCIAL MEDIA SITE 2</a>
                </dd>
              </div>

              <div class="profile-groups" style="padding: 5px;">
                <dt>Groups:</dt>
                <dd>
                  <a href="#">GROUP 1</a>
                </dd>
                <dd>
                  <a href="#">GROUP 2</a>
                </dd>
              </div>

            </dl>
          </div>
        </div>
      </div>
    </div>
  </body>
  <!--<script src="lib/format.js">postformatter(posts-list)</script>-->
</html>
